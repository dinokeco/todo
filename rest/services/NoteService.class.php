<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/NoteDao.class.php';

class NoteService extends BaseService{

  public function __construct(){
    parent::__construct(new NoteDao());
  }

  public function get_user_notes($user){
    return $this->dao->get_user_notes($user['id']);
  }

  public function get_note_by_id($user, $id){
    $note = $this->get_by_id($id);
    // this is business logic of our app
    if ($note['user_id'] != $user['id']){
      throw new Exception("This is hack you will be traced, be prepared :)");
    }
    return $note;
  }

}
?>
