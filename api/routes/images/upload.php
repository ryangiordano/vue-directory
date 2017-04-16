<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../../config/db-connect.php';
require_once '../../config/config.php';
require_once '../../library/jwt.php';
require_once '../../controllers/employee-controller.php';


if($_SERVER['REQUEST_METHOD']=== 'POST'){
  $token = JWT::decode($_POST['token'],jwtKey);
    if($token){
        $uniqueId=$_POST['uniqueId'];
        $firstName=$_POST['firstName'];
        $lastName=$_POST['lastName'];
        $about = $_POST['about'];
        $branch = $_POST['branchId'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $title = $_POST['title'];
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
                 "about"=>$about,
                 "branchId"=>$branch,
                 "phone"=>$phone,
                 "email"=>$email,
                  "title"=>$title,
                 "id"=>$id,
                 "img"=>$imageName,

               );
            $employee = new EmployeeController($DB);
            $result = $employee->editEmployee($request);
            echo $result;
        }else{
          echo 0;
        }
      }
    }



 ?>
