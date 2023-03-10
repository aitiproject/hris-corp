<?php

namespace App\Modules\Employee\Config;

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

$routes->resource('employee', ['namespace' => 'App\Modules\Employee\Controllers']);
$routes->group('employee',['namespace' => 'App\Modules\Employee\Controllers'], function($routes)
{
    $routes->post('batch_update','Employee::batch_update');
});