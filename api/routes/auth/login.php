<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../../config/db-connect.php';
require_once '../../controllers/user-controller.php';
//the code here is what you put in routes

//create new entry, send image file along with it.
//Unique id is created on the php side to link u pusers with their pictures.
if($_SERVER['REQUEST_METHOD']=== 'POST'){
  $email = $_POST['email'];
  $password = $_POST['password'];
$md5 = md5($password);
  $request = array(
       "email"=>$email,
       "password"=>$md5,
     );
  $user = new UserController($DB);
  $result = $user->loginUser($request);
  echo $result;
}

// if($_SERVER['REQUEST_METHOD']=== 'GET'){
//   $employee = new EmployeeController($DB);
//   $employee->getAll();
// }


//delete entry

//get entry by id

//get all entries

//edit entry




 ?>
