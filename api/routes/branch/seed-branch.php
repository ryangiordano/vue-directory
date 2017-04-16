<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../../config/db-connect.php';
require_once '../../controllers/branch-controller.php';

//the code here is what you put in routes

//create new entry

if($_SERVER['REQUEST_METHOD']=== 'GET'){
  $user = new BranchController($DB);
  $user->seedDb();
}


//delete entry

//get entry by id

//get all entries

//edit entry




 ?>
