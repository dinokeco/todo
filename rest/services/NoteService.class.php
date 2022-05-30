<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/NoteDao.class.php';
require_once __DIR__.'/../dao/UserDao.class.php';
require_once __DIR__.'/../dao/SharedNoteDao.class.php';

class NoteService extends BaseService{

  private $user_dao;
  private $shared_note_dao;

  public function __construct(){
    parent::__construct(new NoteDao());
    $this->user_dao = new UserDao();
    $this->shared_note_dao = new SharedNoteDao();
  }

  public function get_user_notes($user, $search = NULL){
    return $this->dao->get_user_notes($user['id'], $search);
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
    unset($entity['status']);
    return parent::update($user, $id, $entity);
  }

  public function delete($user, $id){
    $note = $this->dao->get_by_id($id);
    if ($note['user_id'] != $user['id']){
      throw new Exception("This is hack you will be traced, be prepared :)");
    }
    parent::update($user, $id, ['status' => 'ARCHIVED']);
  }

  public function share($user, $id, $email){
    $note = $this->dao->get_by_id($id);
    if (@$note['user_id'] != $user['id']){
      throw new Exception("This is hack you will be traced, be prepared :)");
    }

    $recpient = $this->user_dao->get_user_by_email($email);
    if (@!isset($recpient['id'])){
      throw new Exception("Recipient ".$email." not found!");
    }

    $shared_note = $this->shared_note_dao->add(['user_id' => $recpient['id'], 'note_id' => $note['id'], 'role' => 'READ']);
    return $shared_note;
  }
}
?>
