<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../../config/db-connect.php';
require_once '../../controllers/employee-controller.php';
require_once '../../config/config.php';
require_once '../../library/jwt.php';
//the code here is what you put in routes

//create new entry, send image file along with it.
//Unique id is created on the php side to link u pusers with their pictures.
if($_SERVER['REQUEST_METHOD']=== 'POST'){
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $uniqueId= uniqid('',true);
  $request = array(
       "firstName"=>$firstName,
       "lastName"=>$lastName,
       "uniqueId"=>$uniqueId,
       "img"=>$uniqueId
     );
  $employee = new EmployeeController($DB);
  $result = $employee->postEmployee($request);//returns the newly inserted employee in object form
  echo $result;
}

if($_SERVER['REQUEST_METHOD']=== 'GET'){
  if(isset($_GET['id'])){
    $employee = new EmployeeController($DB);
    $employee->getEmployee($_GET['id']);
  }else{
    $employee = new EmployeeController($DB);
    $employee->getAll();
  }

}


//delete entry

//get entry by id

//get all entries

//edit entry




 ?>
