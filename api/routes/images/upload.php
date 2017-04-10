<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../../config/db-connect.php';
require_once '../../controllers/employee-controller.php';
require_once  "../../library/bulletproof.php";


$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$id=$_POST['id'];

$image = new Bulletproof\Image($_FILES);
//Get a user along with the payload for the image.
$saveDir = '../../src/assets/images/ryan';
if($image["file"]){
    $image->setName($id);
    $image->setLocation($saveDir);

//if the upload worked.  edit the original file with the url to the image
    if($image->upload()){
      $fullPath = $image->getFullPath();
      $request = array(
           "firstName"=>$firstName,
           "lastName"=>$lastName,
           "img"=>$fullPath,
           "id"=>$id
         );
      $employee = new EmployeeController($DB);
      $result = $employee->editEmployee($request);
      echo $fullPath; // uploads/cat.gif
    }else{
        echo $image["error"];
    }
}



//delete entry

//get entry by id

//get all entries

//edit entry




 ?>
