<?php
class Employee
{
  function __construct($DB,$data = null)
  {
    $this->data = $data;
    $this->DB = $DB;
  }
  //adds a new entry into the DB and then returns the entry as json
  public function save(){
    $insertEntry = $this->DB->prepare("INSERT INTO test.employees (firstName, lastName, img,uniqueId) VALUES(:firstName,:lastName,:img,:uniqueId)");
    $insertEntry->bindValue(':firstName', $this->data['firstName'], PDO::PARAM_STR);
    $insertEntry->bindValue(':lastName', $this->data['lastName'], PDO::PARAM_STR);
    $insertEntry->bindValue(':img', $this->data['img'], PDO::PARAM_STR);
    $insertEntry->bindValue(':uniqueId', $this->data['uniqueId'], PDO::PARAM_STR);
    $insertEntry->execute();
    $id = $this->DB->lastInsertId();

    $query= $this->DB->prepare("SELECT * FROM test.employees WHERE id=:id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    echo json_encode($query->fetchObject());
    //echoes the result of the query in object form

  }
  public function get(){
    $return_array = array();
    $query= $this->DB->query("SELECT * FROM test.employees");
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $row_array['id'] = $row['id'];
      $row_array['firstName'] = $row['firstName'];
      $row_array['lastName'] = $row['lastName'];
      $row_array['img'] = $row['img'];
      $row_array['uniqueId'] = $row['uniqueId'];
      array_push($return_array,$row_array);
      }
    echo json_encode($return_array);
    return json_encode($return_array);
  }
  public function getOne($id){
    $query= $this->DB->prepare("SELECT * FROM test.employees WHERE id=:id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    echo  json_encode($query->fetchObject());
    return json_encode($query->fetchObject());
  }
  public function edit(){
    $editEntry = $this->DB->prepare("UPDATE test.employees SET firstName = :firstName, lastName = :lastName, img = :img, uniqueId = :uniqueId WHERE id =". $this->data['id']);
    $editEntry->bindValue(':firstName', $this->data['firstName'], PDO::PARAM_STR);
    $editEntry->bindValue(':lastName', $this->data['lastName'], PDO::PARAM_STR);
    $editEntry->bindValue(':img', $this->data['img'], PDO::PARAM_STR);
    $editEntry->bindValue(':uniqueId', $this->data['uniqueId'], PDO::PARAM_STR);
    $editEntry->execute();
  }
  public function delete(){
    $deleteEntry = $this->DB->prepare('DELETE FROM test.employees WHERE id=:id');
    $deleteEntry->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
    $deleteEntry->execute();
  }
  public function seedDB(){
    $data[]= array('firstName'=>'Ryan','lastName'=>'Giordano','img'=>'58eb927dbe1048.57054417.jpg','uniqueId'=>uniqid('',true));
    $data[]= array('firstName'=>'Lo','lastName'=>'Giordano','img'=>'58eb927dbe1045.68806606.jpg','uniqueId'=>uniqid('',true));
    $data[]= array('firstName'=>'Matt','lastName'=>'Caldwell','img'=>'58eb927dbe1048.49737697.jpg','uniqueId'=>uniqid('',true));
    $data[]= array('firstName'=>'Andy','lastName'=>'Levenson','img'=>'58eb927dbe1049.31342894.jpg','uniqueId'=>uniqid('',true));
    foreach ($data as $row) {
      $insertEntry = $this->DB->prepare("INSERT INTO test.employees (firstName, lastName, img,uniqueId) VALUES(:firstName,:lastName,:img,:uniqueId)");
      $insertEntry->bindValue(':firstName', $row['firstName'], PDO::PARAM_STR);
      $insertEntry->bindValue(':lastName', $row['lastName'], PDO::PARAM_STR);
      $insertEntry->bindValue(':img', $row['img'], PDO::PARAM_STR);
      $insertEntry->bindValue(':uniqueId', $row['uniqueId'], PDO::PARAM_STR);
      $insertEntry->execute();
    }
  }
}


 ?>
