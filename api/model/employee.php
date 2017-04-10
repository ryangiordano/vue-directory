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
    $insertEntry = $this->DB->prepare("INSERT INTO test.employees (firstName, lastName, img) VALUES(:firstName,:lastName,:img)");
    $insertEntry->bindValue(':firstName', $this->data['firstName'], PDO::PARAM_STR);
    $insertEntry->bindValue(':lastName', $this->data['lastName'], PDO::PARAM_STR);
    $insertEntry->bindValue(':img', $this->data['img'], PDO::PARAM_STR);
    $insertEntry->execute();
    $id = $this->DB->lastInsertId();

    $query= $this->DB->prepare("SELECT * FROM test.employees WHERE id=:id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    echo json_encode($query->fetchObject());
    // return json_encode($query->fetchObject());

  }
  public function get(){
    $return_array = array();
    $query= $this->DB->query("SELECT * FROM test.employees");
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $row_array['id'] = $row['id'];
      $row_array['firstName'] = $row['firstName'];
      $row_array['lastName'] = $row['lastName'];
      $row_array['img'] = $row['img'];
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
  public function edit($id){
    $editEntry = $this->DB->prepare("UPDATE test.employees SET  WHERE user_id = $user_id");
    $editEntry->bindValue(':firstName', $this->data['firstName'], PDO::PARAM_STR);
    $editEntry->bindValue(':lastName', $this->data['lastName'], PDO::PARAM_STR);
    $editEntry->bindValue(':img', $this->data['img'], PDO::PARAM_STR);
    $editEntry->execute();
  }
  public function delete($id){
    $deleteEntry = $this->DB->prepare('DELETE FROM test.employees WHERE id=:id');
    $deleteEntry->bindValue(':id', $id, PDO::PARAM_INT);
    $deleteEntry->execute();
  }
  public function seedDB(){
    $data[]= array('firstName'=>'Ryan','lastName'=>'Giordano','img'=>'https://rlv.zcache.com/daruma_doll_classic_round_sticker-r2c5c052320424af6887f9514385493f2_v9waf_8byvr_324.jpg');
    $data[]= array('firstName'=>'Lo','lastName'=>'Giordano','img'=>'https://yt3.ggpht.com/-V92UP8yaNyQ/AAAAAAAAAAI/AAAAAAAAAAA/zOYDMx8Qk3c/s900-c-k-no-mo-rj-c0xffffff/photo.jpg');
    $data[]= array('firstName'=>'Matt','lastName'=>'Caldwell','img'=>'https://www.what-dog.net/Images/faces2/scroll0015.jpg');
    $data[]= array('firstName'=>'Andy','lastName'=>'Levenson','img'=>'http://www.wikiality.com/file/2016/11/bears1.jpg');
    foreach ($data as $row) {
      $insertEntry = $this->DB->prepare("INSERT INTO test.employees (firstName, lastName, img) VALUES(:firstName,:lastName,:img)");
      $insertEntry->bindValue(':firstName', $row['firstName'], PDO::PARAM_STR);
      $insertEntry->bindValue(':lastName', $row['lastName'], PDO::PARAM_STR);
      $insertEntry->bindValue(':img', $row['img'], PDO::PARAM_STR);
      $insertEntry->execute();
    }
  }
}


 ?>
