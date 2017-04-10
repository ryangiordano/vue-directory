<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../../config/db-connect.php';
require_once '../../controllers/employee-controller.php';

//the code here is what you put in routes

//create new entry

if($_SERVER['REQUEST_METHOD']=== 'GET'){
  $employee = new EmployeeController($DB);
  echo 'DB Seeded';
  $employee->seedDb();
}


//delete entry

//get entry by id

//get all entries

//edit entry




 ?>
