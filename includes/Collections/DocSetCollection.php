<?php

namespace Waypoint\Collections;

class DocSetCollection extends \Gateway\Collection
{
    protected $key = 'doc_sets';
    protected $table = 'doc_sets';
    protected $fillable = ['name', 'description', 'slug', 'icon'];
    protected $package = 'waypoint';

    /**
     * @var array API route configuration
     */
    protected $routes = [
        'enabled' => true,
        'namespace' => 'gateway',
        'version' => 'v1',
        // Route auto-generated from $key: 'doc_sets' -> 'doc-sets'
        'methods' => [
            'get_many' => true,
            'get_one' => true,
            'create' => true,
            'update' => true,
            'delete' => true,
        ],
        'permissions' => [
            'get_many' => [
                'type' => 'public_secured',
                'settings' => []
            ],
            'get_one' => [
                'type' => 'public_secured',
                'settings' => []
            ],
            'create' => [
                'type' => 'protected',
                'settings' => [
                    'capability' => 'edit_posts'
                ]
            ],
            'update' => [
                'type' => 'protected',
                'settings' => [
                    'capability' => 'edit_posts'
                ]
            ],
            'delete' => [
                'type' => 'protected',
                'settings' => [
                    'capability' => 'delete_posts'
                ]
            ],
        ],
    ];

    /**
     * @var array Field definitions
     */
    protected $fields = [
        'name' => [
            'type' => 'text',
            'label' => 'Doc Set Name',
            'required' => true,
            'placeholder' => 'Doc set name...',
        ],
        'slug' => [
            'type'       => 'slug',
            'label'      => 'Slug',
            'required'   => true,
            'watchField' => 'name',
        ],
        'description' => [
            'type' => 'textarea',
            'label' => 'Description',
            'required' => false,
            'placeholder' => 'Doc set description...',
        ],
        'icon' => [
            'type' => 'text',
            'label' => 'Icon',
            'required' => false,
            'placeholder' => 'Icon name or URL...',
        ],
    ];

    /**
     * @var array Filter definitions
     */
    protected $filters = [
        [
            'type' => 'text',
            'field' => 'search',
            'label' => 'Search',
            'placeholder' => 'Search doc sets...',
        ],
        [
            'type' => 'date_range',
            'field' => 'created_at',
            'label' => 'Created Date',
            'placeholder' => [
                'start' => 'Start Date',
                'end' => 'End Date',
            ],
        ],
    ];
}
