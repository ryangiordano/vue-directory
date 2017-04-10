<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../../config/db-connect.php';
require_once '../../controllers/employee-controller.php';
require_once  "../../library/bulletproof.php";
//the code here is what you put in routes

//create new entry, send image file along with it.
if($_SERVER['REQUEST_METHOD']=== 'POST'){
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $img = 'placeholder';
  $request = array(
       "firstName"=>$firstName,
       "lastName"=>$lastName,
       "img"=>$img
     );
  $employee = new EmployeeController($DB);
  $result = $employee->editEmployee($request);
  echo $result;
}


//delete entry

//get entry by id

//get all entries

//edit entry




 ?>