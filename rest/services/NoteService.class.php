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

}
?>
