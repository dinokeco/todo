<?php
abstract class BaseService {

  protected $dao;

  public function __construct($dao){
    $this->dao = $dao;
  }

  public function get_all($user){
    return $this->dao->get_all();
  }

  public function get_by_id($user, $id){
    return $this->dao->get_by_id($id);
  }

  public function add($user, $entity){
    return $this->dao->add($entity);
  }

  public function update($user, $id, $entity){
    return $this->dao->update($id, $entity);
  }

  public function delete($user, $id){
    return $this->dao->delete($id);
  }
}
?>
