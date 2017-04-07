<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../config/db-connect.php';
require_once '../controllers/entries-controller.php';

//the code here is what you put in routes

//create new entry
if($_SERVER['REQUEST_METHOD']=== 'POST'){
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $img = $_POST['img'];
  $request = array(
       "firstName"=>$firstName,
       "lastName"=>$lastName,
       "img"=>$img
     );
  $entry = new EntriesController($DB);
  $entry->postEntry($request);
}

if($_SERVER['REQUEST_METHOD']=== 'GET'){
  $entry = new EntriesController($DB);
  $entry->getAll();
}


//delete entry

//get entry by id

//get all entries

//edit entry




 ?>
