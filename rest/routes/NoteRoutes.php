<?php

// CRUD operations for todos entity

/**
* List all todos
*/
Flight::route('GET /notes', function(){
  Flight::json(Flight::noteService()->get_all());
});

/**
* List invidiual note
*/
Flight::route('GET /notes/@id', function($id){
  Flight::json(Flight::noteService()->get_by_id($id));
});

/**
* List invidiual note todos
*/
Flight::route('GET /notes/@id/todos', function($id){
  Flight::json(Flight::todoService()->get_todos_by_note_id($id));
});


/**
* add notes
*/
Flight::route('POST /notes', function(){
  Flight::json(Flight::noteService()->add(Flight::request()->data->getData()));
});

/**
* update notes
*/
Flight::route('PUT /notes/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::noteService()->update($id, $data));
});

/**
* delete notes
*/
Flight::route('DELETE /notes/@id', function($id){
  Flight::noteService()->delete($id);
  Flight::json(["message" => "deleted"]);
});

?>
