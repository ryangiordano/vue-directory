<?php
class Company
{
  function __construct($DB,$data = null)
  {
    $this->data = $data;
    $this->DB = $DB;
  }
  //adds a new entry into the DB and then returns the entry as json
  public function save(){
    $insertEntry = $this->DB->prepare("INSERT INTO test.company (name, about, tagline,welcome_message, address, logo_image, rates, banner_image) VALUES(:name,:about,:tagline,:welcome_message, :address, :logo_image, :rates, :banner_image)");
    $insertEntry->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
    $insertEntry->bindValue(':about', $this->data['about'], PDO::PARAM_STR);
    $insertEntry->bindValue(':tagline', $this->data['tagline'], PDO::PARAM_STR);
    $insertEntry->bindValue(':welcome_message', $this->data['welcome_message'], PDO::PARAM_STR);
    $insertEntry->bindValue(':address', $this->data['address'], PDO::PARAM_STR);
    $insertEntry->bindValue(':logo_image', $this->data['logo_image'], PDO::PARAM_STR);
    $insertEntry->bindValue(':rates', $this->data['rates'], PDO::PARAM_STR);
    $insertEntry->bindValue(':banner_image', $this->data['banner_image'], PDO::PARAM_STR);

    $insertEntry->execute();
    $id = $this->DB->lastInsertId();

    $query= $this->DB->prepare("SELECT * FROM test.company WHERE id=:id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    echo json_encode($query->fetchObject());
    //echoes the result of the query in object form

  }
  public function get(){
    $returnArray = array();
    $query= $this->DB->query("SELECT * FROM test.company");
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $row_array['id'] = $row['id'];
      $row_array['firstName'] = $row['firstName'];

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
    $query= $this->DB->prepare("SELECT * FROM test.company WHERE id=:id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    echo  json_encode($query->fetchObject());
    return json_encode($query->fetchObject());
  }
  public function edit(){
    $editEntry = $this->DB->prepare("UPDATE test.company SET firstName = :firstName, lastName = :lastName, email = :email, branchId = :branchId, phone = :phone, about = :about, title = :title WHERE id =". $this->data['id']);
    $editEntry->bindValue(':firstName', $this->data['firstName'], PDO::PARAM_STR);
    $editEntry->bindValue(':lastName', $this->data['lastName'], PDO::PARAM_STR);
    $editEntry->bindValue(':email', $this->data['email'], PDO::PARAM_STR);
    $editEntry->bindValue(':branchId', $this->data['branchId'], PDO::PARAM_STR);
    $editEntry->bindValue(':phone', $this->data['phone'], PDO::PARAM_STR);
    $editEntry->bindValue(':about', $this->data['about'], PDO::PARAM_STR);
    $editEntry->bindValue(':title', $this->data['title'], PDO::PARAM_STR);
    $editEntry->execute();
    $query= $this->DB->prepare("SELECT * FROM test.company WHERE id=:id");
    $query->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
    $query->execute();
    return json_encode($query->fetchObject());
  }
  public function delete(){
    $deleteEntry = $this->DB->prepare('DELETE FROM test.company WHERE id=:id');
    $deleteEntry->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
    $deleteEntry->execute();
  }
  public function seedDB(){
    $data[]= array('name'=>'Codigo','tagline'=>'It\'s Go Time','address'=>'Story Avenue, Louisville KY','logo_image'=>'http://www.gocodigo.com/images/codigo-logo-color.png','rates'=>'link/to/rates.json','banner_image'=>'http://www.gocodigo.com/images/codigo-team/codigo-office-front-desk-9.jpg','welcome_message'=>'Welcome to Codigo','about'=>'Codigo is about building innovative marketing tools that enable our customers to make a positive impact on retail behavior. We believe in delivering the highest quality online products for our clients while offering a family-friendly, career-rewarding, fun environment for our employees. Our tech-savvy staff has developed proprietary solutions that include: Digital Signage, Interactive Kiosks, On-Hold Messaging, and Custom Media Production. All of our products are aimed to be user-friendly, cutting edge, and ultimately an effective and efficient way to execute marketing strategies in a digital age.');

    foreach ($data as $row) {
      $insertEntry = $this->DB->prepare("INSERT INTO test.company (name, address,about, welcome_message,banner_image,rates,logo_image,tagline) VALUES(:name,:address,:about, :welcome_message,:banner_image,:rates,:logo_image,:tagline)");
      $insertEntry->bindValue(':name', $row['name'], PDO::PARAM_STR);
      $insertEntry->bindValue(':address', $row['address'], PDO::PARAM_STR);
      $insertEntry->bindValue(':about', $row['about'], PDO::PARAM_STR);
      $insertEntry->bindValue(':welcome_message', $row['welcome_message'], PDO::PARAM_STR);
      $insertEntry->bindValue(':banner_image', $row['banner_image'], PDO::PARAM_STR);
      $insertEntry->bindValue(':rates', $row['rates'], PDO::PARAM_STR);
      $insertEntry->bindValue(':logo_image', $row['logo_image'], PDO::PARAM_STR);
      $insertEntry->bindValue(':tagline', $row['tagline'], PDO::PARAM_STR);
      $insertEntry->execute();
    }
  }
}


 ?>
