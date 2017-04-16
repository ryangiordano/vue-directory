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
  $name = $_POST['name'];
  $location = $_POST['location'];
  $request = array(
       "name"=>$name,
       "location"=>$location,
     );
  $branch = new BranchController($DB);
  $result = $branch->postBranch($request);//returns the newly inserted employee in object form
  echo $result;
}

if($_SERVER['REQUEST_METHOD']=== 'GET'){
  if(isset($_GET['id'])){
    $branch = new BranchController($DB);
    $branch->getEmployee($_GET['id']);
  }else{
    $branch = new BranchController($DB);
    $branch->getAll();
  }

}


//delete entry

//get entry by id

//get all entries

//edit entry




 ?>
