<?php
require_once __DIR__.'/BaseDao.class.php';

class NoteDao extends BaseDao{

  /**
  * constructor of dao class
  */
  public function __construct(){
    parent::__construct("notes");
  }

  public function get_user_notes($user_id, $search = NULL){
  //  return $this->query("SELECT * FROM notes WHERE user_id = :user_id", ['user_id' => $user_id]);
    $query = "(SELECT n.*
    FROM notes n JOIN shared_notes sn ON n.id = sn.note_id AND sn.user_id = :user_id
    ";
    if (isset($search)){
      $query .= " AND n.name LIKE '%".$search."%'";
    }

    $query .= ")
    UNION
    (SELECT b.*
    FROM notes b
    WHERE b.user_id = :user_id";

    if (isset($search)){
      $query .= " AND b.name LIKE '%".$search."%' ";
    }

    $query .=")";

    return $this->query($query, ['user_id' => $user_id]);
  }

  public function get_by_id($id){
    return $this->query_unique('SELECT n.*, DATE_FORMAT(n.created, "%Y-%m-%d") created FROM notes n WHERE n.id = :id', ['id' => $id]);
  }
}

?>
