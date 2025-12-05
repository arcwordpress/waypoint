<?php

/**
 * Plugin Name: Waypoint
 * Description: Multi-set documentation management for WordPress
 * Version: 1.1.7
 * Author: ARC Software
 */

namespace Waypoint;

if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('WAYPOINT_VERSION', '1.1.7');
define('WAYPOINT_PATH', plugin_dir_path(__FILE__));
define('WAYPOINT_URL', plugin_dir_url(__FILE__));
define('WAYPOINT_FILE', __FILE__);

class Plugin
{
    private static $instance = null;
    private $docs_slug = 'docs2'; // Set your docs slug here

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
        add_action('template_redirect', [$this, 'templateLoader']);
        register_activation_hook(WAYPOINT_FILE, [$this, 'activate']);
    }

    public function activate()
    {
        // Create database tables
        Database::install();
        // Register rewrite rules
        $this->addRewriteRules();
        // Flush rewrite rules
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
        // Match /docs and any sub-paths (e.g., /docs/test, /docs/getting-started)
        add_rewrite_rule('^docs(/.*)?$', 'index.php?waypoint_docs=1', 'top');

        // Dynamic rewrite rule for docs slug and any sub-paths
        add_rewrite_rule(
            '^' . $this->docs_slug . '(/.*)?$',
            'index.php?waypoint_docs_dynamic=1',
            'top'
        );
    }

    public function addQueryVars($vars)
    {
        $vars[] = 'waypoint_docs';
        $vars[] = 'waypoint_docs_dynamic';
        return $vars;
    }

    public function templateLoader()
    {
        if (get_query_var('waypoint_docs')) {
            $template = WAYPOINT_PATH . 'templates/docs.php';
            if (file_exists($template)) {
                load_template($template);
                exit;
            }
        }

        if (get_query_var('waypoint_docs_dynamic')) {
            $template = WAYPOINT_PATH . 'templates/docs-nohead.php';
            if (file_exists($template)) {
                load_template($template);
                exit;
            }
        }
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