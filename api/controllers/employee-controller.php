<?php
require_once '../../model/employee.php';
//Route takes requests and tells controller what to do.
//Controller handles firing functions as directed from the route.
//The model interfaces with the database and returns data;

class EmployeeController
{
  function __construct($DB)
  {
    $this->DB = $DB;
  }
    public function postEmployee($request)
    {
      //instantiate an entry model
      $employee = new Employee($this->DB,$request);
      $response = $employee->save();
      return $response;
    }
    public function seedDB()
    {
      //instantiate an entry model
      $employee = new Employee($this->DB);
      $response = $employee->seedDB();
      echo $response;
    }
    public function getAll()
    {
      $employee = new Employee($this->DB);
      $response = $employee->get();
      return $response;
    }
    public function getEmployee($id)
    {
      $employee = new Employee($this->DB);
      $response = $employee->getOne($id);
      return $response;
    }
    public function editEmployee($request){
      $employee = new Employee($this->DB, $request);
      $response = $employee->edit();
      return $response;
    }
    public function deleteEmployee($request)
    {
      $employee= new Employee($this->DB,$request);
      $response= $employee->delete();
      return $response;
    }
}

 ?>
