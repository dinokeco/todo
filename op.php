<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("rest/dao/TodoDao.class.php");

$dao = new TodoDao();

$op = $_REQUEST['op'];

switch ($op) {
  case 'insert':
    $description = $_REQUEST['description'];
    $created = $_REQUEST['created'];
    $dao->add($description, $created);
    break;

  case 'delete':
    $id = $_REQUEST['id'];
    $dao->delete($id);
    echo "DELETED $id";
    break;

  case 'update':
    $id = $_REQUEST['id'];
    $description = $_REQUEST['description'];
    $created = $_REQUEST['created'];
    $dao->update($id, $description, $created);
    echo "UPDATED $id";
    break;

  case 'get':
  default:
    $results = $dao->get_all();
    print_r($results);
    break;
}
?>
