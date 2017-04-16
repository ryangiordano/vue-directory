<?php
require_once '../../model/branch.php';
//Route takes requests and tells controller what to do.
//Controller handles firing functions as directed from the route.
//The model interfaces with the database and returns data;

class BranchController
{
  function __construct($DB)
  {
    $this->DB = $DB;
  }
    public function postBranch($request)
    {
      //instantiate an entry model
      $employee = new Branch($this->DB,$request);
      $response = $employee->save();
      return $response;
    }
    public function seedDB()
    {
      //instantiate an entry model
      $employee = new Branch($this->DB);
      $response = $employee->seedDB();
      echo $response;
    }
    public function getAll()
    {
      $employee = new Branch($this->DB);
      $response = $employee->get();
      return $response;
    }
    public function getBranch($id)
    {
      $employee = new Branch($this->DB);
      $response = $employee->getOne($id);
      return $response;
    }
    public function editBranch($request){
      $employee = new Branch($this->DB, $request);
      $response = $employee->edit();
      return $response;
    }
    public function deleteBranch($request)
    {
      $employee= new Branch($this->DB,$request);
      $response= $employee->delete();
      return $response;
    }
}

 ?>
