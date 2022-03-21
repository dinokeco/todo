<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dao/TodoDao.class.php';
require_once '../vendor/autoload.php';

// CRUD operations for todos entity

/**
* List all todos
*/
Flight::route('/todos', function(){
  $dao = new TodoDao();
  $todos = $dao->get_all();
  Flight::json($todos);
});

/**
* List invidiual todo
*/

/**
* add todo
*/

/**
* update todo
*/

/**
* delete todo
*/



Flight::route('/dorian', function(){
    echo 'hello world DORIAN!';
});

Flight::route('/tin/@name', function($name){
    echo 'hello world TIN!'. $name;
});

Flight::start();
?>
