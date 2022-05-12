<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return response()->json(array("documentation" => 'https://documenter.getpostman.com/view/10514373/UyxhmSBm'), 200);
});

$router->get('/api', function () use ($router) {
    return response()->json(array("documentation" => 'https://documenter.getpostman.com/view/10514373/UyxhmSBm'), 200);
});

$router->group(['prefix' => 'api'], function () use ($router) {
    //utilisateurs
    $router->get('users',  ['uses' => 'UsersController@showAllUsers']);
  
    $router->get('users/{id}', ['uses' => 'UsersController@showOneUser']);
  
    $router->post('users', ['uses' => 'UsersController@create']);
  
    $router->delete('users/{id}', ['uses' => 'UsersController@delete']);
  
    $router->put('users/{id}', ['uses' => 'UsersController@update']);

    //elections
    $router->get('election',  ['uses' => 'ElectionsController@showAllElections']);

    $router->get('election/{id}', ['uses' => 'ElectionsController@showOneElection']);
  
    $router->post('election', ['uses' => 'ElectionsController@create']);
  
    $router->delete('election/{id}', ['uses' => 'ElectionsController@delete']);
  
    $router->put('election/{id}', ['uses' => 'ElectionsController@update']);

    //candidats
    $router->put('candidat/{id}', ['uses' => 'CandidatsController@update']);
});
