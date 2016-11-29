<?php

return [
    'router' => [
        'routes' => [
            'api-rest' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/rest'
                ],
                'child_routes' => [
                    'dive-log' => [
                        'type' => 'Segment',
                        'may_terminate' => true,
                        'options' => [
                            'route' => '/dive-log[/:dive-log_id]',
                            'defaults' => [
                                'controller' => 'Strapieno\DiveLog\Api\V1\Rest\Controller'
                            ],
                            'constraints' => [
                                'dive-log_id' => '[0-9a-f]{24}'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    'matryoshka-apigility' => [
        'matryoshka-connected' => [
                'Strapieno\DiveLog\Api\V1\Rest\ConnectedResource' => [
                    'model' => 'Strapieno\DiveLog\Model\DiveLogModelService',
                    'collection_criteria' => 'Strapieno\DiveLog\Model\Criteria\DiveLogCollectionCriteria',
                    'entity_criteria' => 'Strapieno\Model\Criteria\NotIsolatedActiveRecordCriteria'
            ]
        ]
    ],
    'zf-rest' => [
        'Strapieno\DiveLog\Api\V1\Rest\Controller' => [
            'service_name' => 'dive-log',
            'listener' => 'Strapieno\DiveLog\Api\V1\Rest\ConnectedResource',
            'route_name' => 'api-rest/dive-log',
            'route_identifier_name' => 'dive-log_id',
            'collection_name' => 'dive-logs',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
            ],
            'page_size' => 10,
            'page_size_param' => 'page_size',
            'collection_class' => 'Zend\Paginator\Paginator', // FIXME function?
        ]
    ],
    'zf-content-negotiation' => [
        'accept_whitelist' => [
            'Strapieno\DiveLog\Api\V1\Rest\Controller' => [
                'application/hal+json',
                'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Strapieno\DiveLog\Api\V1\Rest\Controller' => [
                'application/json'
            ],
        ],
    ],
     'zf-hal' => [
        // map each class (by name) to their metadata mappings
        'metadata_map' => [
            'Strapieno\DiveLog\Model\Entity\DiveLogEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api-rest/dive-log',
                'route_identifier_name' => 'dive-log_id',
                'hydrator' => 'DiveLogApiHydrator',
            ],
        ],
    ],
    'zf-content-validation' => [
        'Strapieno\DiveLog\Api\V1\Rest\Controller' => [
            'input_filter' => 'Strapieno\DiveLog\Api\InputFilter\DefaultInputFilter',
            'POST' => 'Strapieno\DiveLog\Api\InputFilter\PostInputFilter',
            'PATCH' => 'Strapieno\DiveLog\Api\InputFilter\PatchInputFilter'
        ]
    ],
    'strapieno_input_filter_specs' => [
        'Strapieno\DiveLog\Api\InputFilter\PostInputFilter' => [
            'merge' => 'Strapieno\DiveLog\Model\InputFilter\DefaultInputFilter',
        ],
        'Strapieno\DiveLog\Api\InputFilter\PatchInputFilter' => [
            'merge' => 'Strapieno\DiveLog\Model\InputFilter\DefaultInputFilter',
        ]
    ]
];
