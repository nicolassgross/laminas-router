<?php

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;

// Rota sem parâmetros
$literalRoute = Literal::factory([
    'route' => '/home',
    'defaults' => [
        'controller' => 'IndexController'
    ],
]);

// Rota com parâmetros
$segmentRoute = Segment::factory([
    'route' => '/:home[/:user_id]',
    'defaults' => [
        'controller' => 'IndexController',
    ],
]);

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => 'IndexController',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'user-info' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/user/:user_id',
                            'defaults' => [
                                'action' => 'view',
                            ],
                        ],
                    ],
                ],
            ],
            'contact' => [
                'type' => 'segment',
                'options' => [
                    'route' => 'contact/:contact_id',
                    'defaults' => [
                        'controller' => 'ContactController',
                    ],
                ],
            ],
        ],
    ],
];

$matches1 = $segmentRoute->match($request);
$matches2 = $literalRoute->match($request);