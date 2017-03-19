<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin('Eav',
    ['path' => '/eav'],
    function (RouteBuilder $routes) {

        $routes->routeClass(DashedRoute::class);
        $routes->scope('/admin', ['prefix' => 'admin'], function(RouteBuilder $routes) {
            $routes->fallbacks(DashedRoute::class);
        });
    }
);
