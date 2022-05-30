<?php
require_once __DIR__.'/BaseDao.class.php';

class NoteDao extends BaseDao{

  /**
  * constructor of dao class
  */
  public function __construct(){
    parent::__construct("notes");
  }

  public function get_user_notes($user_id){
    return $this->query("SELECT * FROM notes WHERE user_id = :user_id", ['user_id' => $user_id]);
  }

}

?>
