<?php
// CRUD operations for todos entity

/**
 * @OA\Get(path="/todos", tags={"todo"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all user todos from the API. ",
 *         @OA\Response( response=200, description="List of todos.")
 * )
 */
Flight::route('GET /todos', function(){
  Flight::json(Flight::todoService()->get_all());
});

/**
* List invidiual todo
*/
Flight::route('GET /todos/@id', function($id){
  Flight::json(Flight::todoService()->get_by_id($id));
});

/**
* add todo
*/
Flight::route('POST /todos', function(){
  Flight::json(Flight::todoService()->add(Flight::request()->data->getData()));
});

/**
* update todo
*/
Flight::route('PUT /todos/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::todoService()->update($id, $data));
});

/**
* delete todo
*/
Flight::route('DELETE /todos/@id', function($id){
  Flight::todoService()->delete($id);
  Flight::json(["message" => "deleted"]);
});

?>
