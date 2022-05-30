<?php
require_once __DIR__.'/BaseDao.class.php';

class SharedNoteDao extends BaseDao{

  public function __construct(){
    parent::__construct("shared_notes");
  }

}
