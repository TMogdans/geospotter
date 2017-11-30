<?php

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->get('/findNearby', 'LocationController@findNearby');
    $router->get('/findByZip/{zip}', 'LocationController@findByZip');
    $router->get('/findByName/{name}', 'LocationController@findByName');
});