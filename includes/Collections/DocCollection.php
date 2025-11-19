<?php

namespace Waypoint\Collections;

class DocCollection extends \Gateway\Collection
{
    protected $key = 'docs';
    protected $table = 'docs';
    protected $fillable = ['doc_group_id', 'title', 'content', 'slug', 'position'];
    protected $package = 'waypoint';

    /**
     * @var array API route configuration
     */
    protected $routes = [
        'enabled' => true,
        'namespace' => 'gateway',
        'version' => 'v1',
        'route' => 'docs',
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
        'doc_group_id' => [
            'type' => 'relation',
            'label' => 'Doc Group',
            'required' => true,
            'relation' => [
                'endpoint' => '/wp-json/gateway/v1/doc-groups',
                'labelField' => 'title',
                'valueField' => 'id',
                'placeholder' => 'Select a doc group...',
            ],
        ],
        'title' => [
            'type' => 'text',
            'label' => 'Doc Title',
            'required' => true,
            'placeholder' => 'Doc title...',
        ],
        'slug' => [
            'type'       => 'slug',
            'label'      => 'Slug',
            'required'   => true,
            'watchField' => 'title',
        ],
        'content' => [
            'type' => 'markdown',
            'label' => 'Content',
        ],
        'position' => [
            'type' => 'number',
            'label' => 'Position',
            'required' => false,
            'default' => 0,
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
            'placeholder' => 'Search docs...',
        ],
        [
            'type' => 'select',
            'field' => 'doc_group_id',
            'label' => 'Doc Group',
            'placeholder' => 'All Doc Groups',
            'options_endpoint' => '/wp-json/gateway/v1/doc-groups',
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
