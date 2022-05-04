<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->get('/', function () use ($router) {
    //mode d'emploil
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('users',  ['uses' => 'UsersController@showAllUsers']);
  
    $router->get('users/{id}', ['uses' => 'UsersController@showOneUser']);
  
    $router->post('users', ['uses' => 'UsersController@create']);
  
    $router->delete('users/{id}', ['uses' => 'UsersController@delete']);
  
    $router->put('users/{id}', ['uses' => 'UsersController@update']);
});
