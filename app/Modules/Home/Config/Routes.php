<?php

namespace App\Modules\Home\Config;

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/test', 'Home::test');
