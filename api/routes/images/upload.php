<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../../config/db-connect.php';
require_once '../../controllers/employee-controller.php';
require_once  "../../library/bulletproof.php";



$uniqueId=$_POST['uniqueId'];
$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$id = $_POST['id'];

$image_base64 = $_POST['file'];
$image_base64 = str_replace("data:image/jpeg;base64,", "", $image_base64);
$image_base64 = str_replace(" ", "+", $image_base64);
//Convert base64 string to image data
$image = base64_decode($image_base64);
$saveDir = '../../src/assets/images/ryan/'.$uniqueId.'.jpeg';

if(file_put_contents($saveDir, $image)){
    $imageName = $uniqueId.'.jpeg';
    $request = array(
         "firstName"=>$firstName,
         "lastName"=>$lastName,
         "img"=>$imageName,
         "uniqueId"=>$uniqueId,
         "id"=>$id
       );
    $employee = new EmployeeController($DB);
    $result = $employee->editEmployee($request);
    echo $result;
}else{
  echo 0;
}
// $image = new Bulletproof\Image($_FILES);
// //Get a user along with the payload for the image.
// $saveDir = '../../src/assets/images/ryan';
// if($image["file"]){
//     $image->setName($uniqueId);
//     $image->setLocation($saveDir);
//
// //if the upload worked.  edit the original file with the url to the image
//   // $image->upload();
// if($image->upload()){
//   $imageName = $image->getName() .'.'. $image->getMime();
//   $request = array(
//        "firstName"=>$firstName,
//        "lastName"=>$lastName,
//        "img"=>$imageName,
//        "uniqueId"=>$uniqueId,
//        "id"=>$id
//      );
//   $employee = new EmployeeController($DB);
//   $result = $employee->editEmployee($request);
//   echo $image->getJson();
// }else{
//     echo $image["error"];
// }
// }



//delete entry

//get entry by id

//get all entries

//edit entry




 ?>
