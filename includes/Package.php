<?php

namespace Waypoint;

class Package extends \Gateway\Package
{
    protected $key = 'waypoint';
    protected $name = 'Waypoint';
    protected $description = 'Multi-set documentation management for WordPress';
    protected $icon = 'book';
    protected $version = WAYPOINT_VERSION;
}
