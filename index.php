<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Welcome to dyamic web from past century";

require_once("rest/dao/TodoDao.class.php");

$dao = new TodoDao();
$results = $dao->get_all();
print_r($results);
?>
