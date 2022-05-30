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

  public function get_by_id($user, $id){
    $note = parent::get_by_id($user, $id);
    // this is business logic of our app
    if ($note['user_id'] != $user['id']){
      throw new Exception("This is hack you will be traced, be prepared :)");
    }

    // what about sharing of notes?
    return $note;
  }

  public function add($user, $entity){
    $entity['user_id'] = $user['id'];
    return parent::add($user, $entity);
  }

  public function update($user, $id, $entity){
    $note = $this->dao->get_by_id($id);
    if ($note['user_id'] != $user['id']){
      throw new Exception("This is hack you will be traced, be prepared :)");
    }
    unset($entity['user_id']);
    return parent::update($user, $id, $entity);
  }

  public function delete($user, $id){
    $note = $this->dao->get_by_id($id);
    if ($note['user_id'] != $user['id']){
      throw new Exception("This is hack you will be traced, be prepared :)");
    }
    parent::update($user, $id, ['status' => 'ARCHIVED']);
  }
}
?>
