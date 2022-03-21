<?php

class TodoDao{

  private $conn;

  /**
  * constructor of dao class
  */
  public function __construct(){
    $servername = "localhost";
    $username = "todo";
    $password = "todo";
    $schema = "todo";
    $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
    // set the PDO error mode to exception
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  /**
  * Method used to read all todo objects from database
  */
  public function get_all(){
    $stmt = $this->conn->prepare("SELECT * FROM todos");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_by_id($id){
    $stmt = $this->conn->prepare("SELECT * FROM todos WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return reset($result);
  }

  /**
  * Method used to add todo to the database
  */
  public function add($todo){
    $stmt = $this->conn->prepare("INSERT INTO todos (description, created) VALUES (:description, :created)");
    $stmt->execute($todo);
    $todo['id'] = $this->conn->lastInsertId();
    return $todo;
  }

  /**
  * Delete todo record from the database
  */
  public function delete($id){
    $stmt = $this->conn->prepare("DELETE FROM todos WHERE id=:id");
    $stmt->bindParam(':id', $id); // SQL injection prevention
    $stmt->execute();
  }

  /**
  * Update todo record
  */
  public function update($todo){
    $stmt = $this->conn->prepare("UPDATE todos SET description=:description, created=:created WHERE id=:id");
    $stmt->execute($todo);
    return $todo;
  }

}

?>
