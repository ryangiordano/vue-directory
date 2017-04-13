<?php
class User
{
  function __construct($DB,$data = null)
  {
    $this->data = $data;
    $this->DB = $DB;
  }
  //adds a new entry into the DB and then returns the entry as json
  public function create(){
    $insertEntry = $this->DB->prepare("INSERT INTO test.users (firstName, lastName, email,password) VALUES(:firstName,:lastName,:email,:password)");
    $insertEntry->bindValue(':firstName', $this->data['firstName'], PDO::PARAM_STR);
    $insertEntry->bindValue(':lastName', $this->data['lastName'], PDO::PARAM_STR);
    $insertEntry->bindValue(':email', $this->data['email'], PDO::PARAM_STR);
    $insertEntry->bindValue(':password', $this->data['password'], PDO::PARAM_STR);
    $insertEntry->execute();
    $id = $this->DB->lastInsertId();

    $query= $this->DB->prepare("SELECT * FROM test.users WHERE id=:id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    echo json_encode($query->fetchObject());
    //echoes the result of the query in object form

  }
  public function get(){
    $returnArray = array();
    $query= $this->DB->query("SELECT * FROM test.users");
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $row_array['id'] = $row['id'];
      $row_array['firstName'] = $row['firstName'];
      $row_array['lastName'] = $row['lastName'];
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
    $query= $this->DB->prepare("SELECT * FROM test.users WHERE id=:id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    if($query->fetchObject()){
      header('HTTP/1.1 204 No results found');
      header('Content-Type: application/json; charset=UTF-8');
      print json_encode(array('error'=>'No results found.'));
    }else{
      header('Content-Type: application/json');
      print json_encode($query->fetchObject());
    }
  }
  public function login(){
    $password = $this->data['password'];
    $email = $this->data['email'];
    $query= $this->DB->prepare("SELECT * FROM test.users WHERE email=:email AND password=:password");
    $query->bindValue(':email', $email, PDO::PARAM_INT);
    $query->bindValue(':password', $password, PDO::PARAM_INT);
    $query->execute();
    if($query->fetchObject()){
      header('HTTP/1.1 200 Login Successful');
      header('Content-Type: application/json; charset=UTF-8');
      print json_encode($query->fetchObject());
    }else{
      header('HTTP/1.1 500 No user found');
      header('Content-Type: application/json');
      print json_encode(array("error"=>"No user found"));
    }
  }
  public function edit(){
    $editEntry = $this->DB->prepare("UPDATE test.users SET firstName = :firstName, lastName = :lastName, img = :img, uniqueId = :uniqueId WHERE id =". $this->data['id']);
    $editEntry->bindValue(':firstName', $this->data['firstName'], PDO::PARAM_STR);
    $editEntry->bindValue(':lastName', $this->data['lastName'], PDO::PARAM_STR);
    $editEntry->bindValue(':img', $this->data['img'], PDO::PARAM_STR);
    $editEntry->bindValue(':uniqueId', $this->data['uniqueId'], PDO::PARAM_STR);
    $editEntry->execute();
    $query= $this->DB->prepare("SELECT * FROM test.users WHERE id=:id");
    $query->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
    $query->execute();
    return json_encode($query->fetchObject());
  }
  public function delete(){
    $deleteEntry = $this->DB->prepare('DELETE FROM test.users WHERE id=:id');
    $deleteEntry->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
    print "Deleted User";
  }
  public function seedDB(){
    $data[]= array('firstName'=>'Ryan','lastName'=>'Giordano','email'=>'ryancodigo@gmail.com','password'=>'5f4dcc3b5aa765d61d8327deb882cf99');
    $data[]= array('firstName'=>'Admin','lastName'=>'Adminerson','email'=>'admin@gmail.com','password'=>'5f4dcc3b5aa765d61d8327deb882cf99');
    foreach ($data as $row) {
      $insertEntry = $this->DB->prepare("INSERT INTO test.users (firstName, lastName, password,email) VALUES(:firstName,:lastName,:password,:email)");
      $insertEntry->bindValue(':firstName', $row['firstName'], PDO::PARAM_STR);
      $insertEntry->bindValue(':lastName', $row['lastName'], PDO::PARAM_STR);
      $insertEntry->bindValue(':password', $row['password'], PDO::PARAM_STR);
      $insertEntry->bindValue(':email', $row['email'], PDO::PARAM_STR);
      $insertEntry->execute();
    }
    print "Database seeded";

  }
}


 ?>
