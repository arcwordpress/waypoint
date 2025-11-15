<?php

namespace Waypoint;

use Gateway\Package\Package as GatewayPackage;

class Package extends GatewayPackage
{
    protected $key = 'waypoint';
    protected $label = 'Waypoint';
    protected $description = 'Multi-set documentation management for WordPress';
    protected $icon = 'dashicons-book';
    protected $position = 33;
    protected $capability = 'edit_posts';
    protected $parent = null;
}
