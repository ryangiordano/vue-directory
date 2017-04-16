<?php
class Branch
{
  function __construct($DB,$data = null)
  {
    $this->data = $data;
    $this->DB = $DB;
  }
  //adds a new entry into the DB and then returns the entry as json
  public function save(){
    $insertEntry = $this->DB->prepare("INSERT INTO test.branches (firstName, lastName, img,uniqueId) VALUES(:firstName,:lastName,:img,:uniqueId)");
    $insertEntry->bindValue(':firstName', $this->data['firstName'], PDO::PARAM_STR);
    $insertEntry->bindValue(':lastName', $this->data['lastName'], PDO::PARAM_STR);
    $insertEntry->bindValue(':img', $this->data['img'], PDO::PARAM_STR);
    $insertEntry->bindValue(':uniqueId', $this->data['uniqueId'], PDO::PARAM_STR);
    $insertEntry->execute();
    $id = $this->DB->lastInsertId();

    $query= $this->DB->prepare("SELECT * FROM test.branches WHERE id=:id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    echo json_encode($query->fetchObject());
    //echoes the result of the query in object form

  }
  public function get(){
    $returnArray = array();
    $query= $this->DB->query("SELECT * FROM test.branches");
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $row_array['id'] = $row['id'];
      $row_array['firstName'] = $row['firstName'];
      $row_array['lastName'] = $row['lastName'];
      $row_array['img'] = $row['img'];
      $row_array['uniqueId'] = $row['uniqueId'];
      $row_array['title'] = $row['title'];
      $row_array['branchId'] = $row['branchId'];
      $row_array['email'] = $row['email'];
      $row_array['phone'] = $row['phone'];
      array_push($returnArray,$row_array);
      }
      if(count($returnArray)<=0){
        header('HTTP/1.1 204 No results found');
        header('Content-Type: application/json; charset=UTF-8');

        print json_encode(array('error'=>'No results found.'));
      }else{
        header('Content-Type: application/json');
        print json_encode($returnArray);
        // return json_encode($returnArray);
      }

  }
  public function getOne($id){
    $query= $this->DB->prepare("SELECT * FROM test.branches WHERE id=:id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    echo  json_encode($query->fetchObject());
    return json_encode($query->fetchObject());
  }
  public function edit(){
    $editEntry = $this->DB->prepare("UPDATE test.branches SET firstName = :firstName, lastName = :lastName, email = :email, branchId = :branchId, phone = :phone, about = :about, title = :title WHERE id =". $this->data['id']);
    $editEntry->bindValue(':firstName', $this->data['firstName'], PDO::PARAM_STR);
    $editEntry->bindValue(':lastName', $this->data['lastName'], PDO::PARAM_STR);
    $editEntry->bindValue(':email', $this->data['email'], PDO::PARAM_STR);
    $editEntry->bindValue(':branchId', $this->data['branchId'], PDO::PARAM_STR);
    $editEntry->bindValue(':phone', $this->data['phone'], PDO::PARAM_STR);
    $editEntry->bindValue(':about', $this->data['about'], PDO::PARAM_STR);
    $editEntry->bindValue(':title', $this->data['title'], PDO::PARAM_STR);
    $editEntry->execute();
    $query= $this->DB->prepare("SELECT * FROM test.branches WHERE id=:id");
    $query->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
    $query->execute();
    return json_encode($query->fetchObject());
  }
  public function delete(){
    $deleteEntry = $this->DB->prepare('DELETE FROM test.branches WHERE id=:id');
    $deleteEntry->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
    $deleteEntry->execute();
  }
  public function seedDB(){
    $data[]= array('name'=>'Louisville','location'=>'Louisville, Kentucky');
    $data[]= array('name'=>'Tokyo','location'=>'Tokyo Japan');
    foreach ($data as $row) {
      $insertEntry = $this->DB->prepare("INSERT INTO test.branches (name, location) VALUES(:name,:location)");
      $insertEntry->bindValue(':name', $row['name'], PDO::PARAM_STR);
      $insertEntry->bindValue(':location', $row['location'], PDO::PARAM_STR);
      $insertEntry->execute();
    }
  }
}


 ?>
