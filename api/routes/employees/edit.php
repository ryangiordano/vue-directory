<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../../config/db-connect.php';
require_once '../../config/config.php';
require_once '../../library/jwt.php';
require_once '../../controllers/employee-controller.php';
//the code here is what you put in routes

//create new entry, send image file along with it.
if($_SERVER['REQUEST_METHOD']=== 'POST'){
  $token = JWT::decode($_POST['token'],jwtKey);
    if($token){
      $firstName = $_POST['firstName'];
      $lastName = $_POST['lastName'];
      $about = $_POST['about'];
      $branch = $_POST['branchId'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $title = $_POST['title'];
      $id = $_POST['id'];
      $request = array(
           "firstName"=>$firstName,
           "lastName"=>$lastName,
           "about"=>$about,
           "branchId"=>$branch,
           "phone"=>$phone,
           "email"=>$email,
                  "title"=>$title,
           "id"=>$id
         );
  $employee = new EmployeeController($DB);
  $result = $employee->editEmployee($request);
  echo $result;
}else{
  echo "Unauthorized";
}
}


//delete entry

//get entry by id

//get all entries

//edit entry




 ?>
