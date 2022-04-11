<?php
require_once __DIR__.'/BaseDao.class.php';

class TodoDao extends BaseDao{
  /**
  * constructor of dao class
  */
  public function __construct(){
    parent::__construct("todos");
  }

  public function get_todos_by_note_id($note_id){
    return $this->query("SELECT * FROM todos WHERE note_id = :note_id", ['note_id' => $note_id]);
  }
}

?>
