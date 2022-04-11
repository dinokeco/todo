<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/NoteDao.class.php';

class NoteService extends BaseService{

  public function __construct(){
    parent::__construct(new NoteDao());
  }

}
?>
