<?php
/**
 * @OA\Get(path="/notes", tags={"notes"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all user notes from the API. ",
 *         @OA\Parameter(in="query", name="search", description="Search critieri"),
 *         @OA\Response( response=200, description="List of notes.")
 * )
 */
Flight::route('GET /notes', function(){
  // who is the user who calls this method?
  $user = Flight::get('user');
  $search = Flight::query('search');

  Flight::json(Flight::noteService()->get_user_notes($user, $search));
});

/**
 * @OA\Get(path="/notes/{id}", tags={"notes"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Id of note"),
 *     @OA\Response(response="200", description="Fetch individual note")
 * )
 */
Flight::route('GET /notes/@id', function($id){
  Flight::json(Flight::noteService()->get_by_id(Flight::get('user'), $id));
});

/**
 * @OA\Get(path="/notes/{id}/todos", tags={"notes"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="List todos"),
 *     @OA\Response(response="200", description="Fetch note's todos")
 * )
 */
Flight::route('GET /notes/@id/todos', function($id){
  Flight::json(Flight::todoService()->get_todos_by_note_id($id));
});

/**
* @OA\Post(
*     path="/notes", security={{"ApiKeyAuth": {}}},
*     description="Add user note",
*     tags={"notes"},
*     @OA\RequestBody(description="Basic note info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="test",	description="Title of the note"),
*    				@OA\Property(property="description", type="string", example="test",	description="Short note description" ),
*           @OA\Property(property="color", type="string", example="white",	description="white, red, blue, ..." ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Note that has been created"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('POST /notes', function(){
  Flight::json(Flight::noteService()->add(Flight::get('user'), Flight::request()->data->getData()));
});

/**
* @OA\Put(
*     path="/notes/{id}", security={{"ApiKeyAuth": {}}},
*     description="Update user note",
*     tags={"notes"},
*     @OA\Parameter(in="path", name="id", example=1, description="Note ID"),
*     @OA\RequestBody(description="Basic note info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="test",	description="Title of the note"),
*    				@OA\Property(property="description", type="string", example="test",	description="Short note description" ),
*           @OA\Property(property="color", type="string", example="white",	description="white, red, blue, ..." ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Note that has been updated"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('PUT /notes/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::noteService()->update(Flight::get('user'), $id, $data));
});

/**
* @OA\Delete(
*     path="/notes/{id}", security={{"ApiKeyAuth": {}}},
*     description="Soft delete user note",
*     tags={"notes"},
*     @OA\Parameter(in="path", name="id", example=1, description="Note ID"),
*     @OA\Response(
*         response=200,
*         description="Note deleted"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('DELETE /notes/@id', function($id){
  Flight::noteService()->delete(Flight::get('user'), $id);
  Flight::json(["message" => "deleted"]);
});

/**
* @OA\Post(
*     path="/notes/{id}/share", security={{"ApiKeyAuth": {}}},
*     description="Share user note",
*     @OA\Parameter(in="path", name="id", example=1, description="Note ID"),
*     tags={"notes"},
*     @OA\RequestBody(description="Recipient info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="email", type="string", example="dino.keco@ibu.edu.ba",	description="Recipient of the note")
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Note that has been shared"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('POST /notes/@id/share', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::noteService()->share(Flight::get('user'), $id, $data['email']));
});

?>
