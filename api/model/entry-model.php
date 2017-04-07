<?php
class Entry
{
  function __construct($DB,$data = null)
  {
    $this->data = $data;
    $this->DB = $DB;
  }
  public function save(){
    $insertEntry = $this->DB->prepare("INSERT INTO test.entry (firstName, lastName, img) VALUES(:firstName,:lastName,:img)");
    $insertEntry->bindValue(':firstName', $this->data['firstName'], PDO::PARAM_STR);
    $insertEntry->bindValue(':lastName', $this->data['lastName'], PDO::PARAM_STR);
    $insertEntry->bindValue(':img', $this->data['img'], PDO::PARAM_STR);
    $insertEntry->execute();
  }
  public function get(){
    $return_array = array();
    $query= $this->DB->query("SELECT * FROM test.entry");
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
    $query= $this->DB->prepare("SELECT * FROM test.entry WHERE id=:id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    echo  json_encode($query->fetchObject());
    return json_encode($query->fetchObject());
  }
  public function edit($id){
    $editEntry = $this->DB->prepare("UPDATE test.entry SET  WHERE user_id = $user_id");
    $editEntry->bindValue(':firstName', $this->data['firstName'], PDO::PARAM_STR);
    $editEntry->bindValue(':lastName', $this->data['lastName'], PDO::PARAM_STR);
    $editEntry->bindValue(':img', $this->data['img'], PDO::PARAM_STR);
    $editEntry->execute();
  }
  public function delete($id){
    $deleteEntry = $this->DB->prepare('DELETE FROM test.entry WHERE id=:id');
    $deleteEntry->bindValue(':id', $id, PDO::PARAM_INT);
    $deleteEntry->execute();
  }
}


 ?>
