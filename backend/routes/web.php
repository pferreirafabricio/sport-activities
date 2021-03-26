<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['name' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'sports'], function () use ($router) {
        $router->get('/sports/activies', function () {
            return ['1', '2'];
        });

        $router->post('/sports/activity', function () {
            return response()->json(['some'], 400);
        });
    });
});
