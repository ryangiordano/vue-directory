<?php
require_once '../../model/user.php';
//Route takes requests and tells controller what to do.
//Controller handles firing functions as directed from the route.
//The model interfaces with the database and returns data;

class UserController
{
  function __construct($DB)
  {
    $this->DB = $DB;
  }
    public function createUser($request)
    {
      //instantiate an entry model
      $user = new User($this->DB,$request);
      $response = $user->save();
      return $response;
    }
    public function seedDB()
    {
      //instantiate an entry model
      $user = new User($this->DB);
      $response = $user->seedDB();
      echo $response;
    }
    public function getAll()
    {
      $user = new User($this->DB);
      $response = $user->get();
      return $response;
    }
    public function getUser($id)
    {
      $user = new User($this->DB);
      $response = $user->getOne($id);
      return $response;
    }
    public function editUser($request){
      $user = new User($this->DB, $request);
      $response = $user->edit();
      return $response;
    }
    public function deleteEmployee($request)
    {
      $user= new User($this->DB,$request);
      $response= $user->delete();
      return $response;
    }
    public function loginUser($request){
      $user = new User($this->DB,$request);
      $response= $user->login();
      return $response;
    }
}

 ?>
