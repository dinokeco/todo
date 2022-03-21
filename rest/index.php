<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dao/TodoDao.class.php';
require_once '../vendor/autoload.php';

Flight::register('todoDao', 'TodoDao');

// CRUD operations for todos entity

/**
* List all todos
*/
Flight::route('GET /todos', function(){
  Flight::json(Flight::todoDao()->get_all());
});

/**
* List invidiual todo
*/
Flight::route('GET /todos/@id', function($id){
  Flight::json(Flight::todoDao()->get_by_id($id));
});

/**
* add todo
*/
Flight::route('POST /todos', function(){
  Flight::json(Flight::todoDao()->add(Flight::request()->data->getData()));
});

/**
* update todo
*/
Flight::route('PUT /todos/@id', function($id){
  $data = Flight::request()->data->getData();
  $data['id'] = $id;
  Flight::json(Flight::todoDao()->update($data));
});

/**
* delete todo
*/
Flight::route('DELETE /todos/@id', function($id){
  Flight::todoDao()->delete($id);
  Flight::json(["message" => "deleted"]);
});

Flight::start();
?>
