<?php
// CRUD operations for todos entity

/**
 * @OA\Get(path="/notes", tags={"todo"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all user notes from the API. ",
 *         @OA\Response( response=200, description="List of notes.")
 * )
 */
Flight::route('GET /notes', function(){
  Flight::json(Flight::noteService()->get_all());
});

/**
 * @OA\Get(path="/notes/{id}", tags={"todo"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Id of note"),
 *     @OA\Response(response="200", description="Fetch individual note")
 * )
 */
Flight::route('GET /notes/@id', function($id){
  Flight::json(Flight::noteService()->get_by_id($id));
});

/**
 * @OA\Get(path="/notes/{id}/todos", tags={"todo"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="List todos"),
 *     @OA\Response(response="200", description="Fetch note's todos")
 * )
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
