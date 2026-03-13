<?php

/**
 * Plugin Name: Waypoint
 * Description: Multi-set documentation management for WordPress. Extends Gateway.
 * Version: 1.1.10
 * Author: ARCWP
 */

namespace Waypoint;

if (!defined('ABSPATH')) {
    exit;
}

define('WAYPOINT_VERSION', '1.1.10');
define('WAYPOINT_PATH', plugin_dir_path(__FILE__));
define('WAYPOINT_URL', plugin_dir_url(__FILE__));
define('WAYPOINT_FILE', __FILE__);

class Plugin
{
    private static $instance = null;
    private $docs_slug = 'docs';

    private function __construct()
    {
        $this->registerAutoloader();
        $this->registerHooks();
    }

    private function registerHooks()
    {
        add_action('gateway_loaded', [$this, 'registerPackage']);
        add_action('gateway_loaded', [$this, 'registerCollections']);
        add_action('init', [$this, 'addRewriteRules']);
        add_filter('query_vars', [$this, 'addQueryVars']);
        add_filter('template_include', [$this, 'templateLoader']);
        register_activation_hook(WAYPOINT_FILE, [$this, 'activate']);
    }

    public function activate()
    {
        Database::install();
        $this->addRewriteRules();
        flush_rewrite_rules();
    }

    public function registerPackage()
    {
        (new Package())->register();
    }

    public function registerCollections()
    {
        if (!class_exists('\Gateway\Collection')) {
            return;
        }

        Collections\DocSetCollection::register();
        Collections\DocGroupCollection::register();
        Collections\DocCollection::register();
    }

    public function addRewriteRules()
    {
        add_rewrite_rule('^docs(/.*)?/?$', 'index.php?waypoint_docs=$matches[1]', 'top');
        add_rewrite_tag('%waypoint_docs%', '(.*)');

        $rules = get_option('rewrite_rules');
        if (!isset($rules['^docs(/.*)?/?$'])) {
            flush_rewrite_rules(false);
        }
    }

    public function addQueryVars($vars)
    {
        $vars[] = 'waypoint_docs';
        return $vars;
    }

    public function templateLoader($template)
    {
        if (false !== get_query_var('waypoint_docs', false)) {
            $custom = WAYPOINT_PATH . 'templates/docs.php';
            if (file_exists($custom)) {
                return $custom;
            }
        }
        return $template;
    }

    public static function init()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function registerAutoloader()
    {
        spl_autoload_register(function ($class) {
            // Only autoload classes in the Waypoint namespace
            if (strpos($class, 'Waypoint\\') !== 0) {
                return;
            }

            // Remove the Waypoint\ prefix
            $class = substr($class, strlen('Waypoint\\'));

            // Convert namespace separators to directory separators
            $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

            // Build the file path
            $file = __DIR__ . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . $class . '.php';

            // Include the file if it exists
            if (file_exists($file)) {
                require_once $file;
            }
        });
    }
}

// Self-initialize
Plugin::init();