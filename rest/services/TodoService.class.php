<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/TodoDao.class.php';

class TodoService extends BaseService{

  public function __construct(){
    parent::__construct(new TodoDao());
  }

}
?>
