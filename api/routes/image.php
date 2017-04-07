<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../config/db-connect.php';
require_once '../controllers/entries-controller.php';

//the code here is what you put in routes

//create new entry
if($_SERVER['REQUEST_METHOD']=== 'POST'){
  // $image = $_POST['image'];
  if(isset($_POST['image'])){
    $target_dir = "../../src/assets/images/";
    $target_file = $target_dir . basename($_POST["image"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    if (move_uploaded_file($_POST['image'], $target_dir)) {
      echo "File is valid, and was successfully uploaded.\n";
    } else {
       echo "Upload failed";
    }
  }

  // Check if image file is a actual image or fake image


  // echo "</p>";
  // echo '<pre>';
  // echo 'Here is some more debugging info:';
  // print_r($_FILES);
  // print "</pre>";

}



//delete entry

//get entry by id

//get all entries

//edit entry




 ?>
