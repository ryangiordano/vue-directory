<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../../config/db-connect.php';
require_once '../../config/config.php';
require_once '../../controllers/user-controller.php';
//the code here is what you put in routes

//create new entry, send image file along with it.
//Unique id is created on the php side to link u pusers with their pictures.
if($_SERVER['REQUEST_METHOD']=== 'POST'){
  if(isset($_POST['decodeToken']) && isset($_POST['token'])){
    $token = JWT::decode($_POST['token'],jwtKey);
    if($token){
      $token->data->user;
      $user= array('firstName'=>$token->data->user->firstName, 'lastName'=>$token->data->user->lastName,'id'=>$token->data->user->id,'email'=>$token->data->user->email);

      echo json_encode($user);
      // $user = new UserController($DB);
      // echo $token['data']['user']['id'];
      // $result = $user->getUser($token['data']['user']['id']);
      // echo $result;
    }

  }
}

if($_SERVER['REQUEST_METHOD']=== 'GET'){
  $user = new UserController($DB);
  $user->getAll();
}


//delete entry

//get entry by id

//get all entries

//edit entry




 ?>
