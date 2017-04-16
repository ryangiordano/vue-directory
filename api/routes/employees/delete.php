<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../../config/db-connect.php';
require_once '../../controllers/employee-controller.php';
require_once  "../../library/bulletproof.php";
//the code here is what you put in routes

//create new entry, send image file along with it.
if($_SERVER['REQUEST_METHOD']=== 'POST'){
  $img = $_POST['img'];
  $id = $_POST['id'];
  $request = array(
      "id"=>$id
     );
  $employee = new EmployeeController($DB);
  $result = $employee->deleteEmployee($request);
  $dir = '../../src/assets/images/ryan/'.$img;
  if(file_exists($dir)){
    unlink($dir);
  }else{
    echo "file does not exist";
  }




}





 ?>
