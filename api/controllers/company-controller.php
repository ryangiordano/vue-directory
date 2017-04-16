<?php
require_once '../../model/company.php';
//Route takes requests and tells controller what to do.
//Controller handles firing functions as directed from the route.
//The model interfaces with the database and returns data;

class CompanyController
{
  function __construct($DB)
  {
    $this->DB = $DB;
  }
    public function postCompany($request)
    {
      //instantiate an entry model
      $employee = new Company($this->DB,$request);
      $response = $employee->save();
      return $response;
    }
    public function seedDB()
    {
      //instantiate an entry model
      $employee = new Company($this->DB);
      $response = $employee->seedDB();
      echo $response;
    }
    public function getAll()
    {
      $employee = new Company($this->DB);
      $response = $employee->get();
      return $response;
    }
    public function getCompany($id)
    {
      $employee = new Company($this->DB);
      $response = $employee->getOne($id);
      return $response;
    }
    public function editCompany($request){
      $employee = new Company($this->DB, $request);
      $response = $employee->edit();
      return $response;
    }
    public function deleteCompany($request)
    {
      $employee= new Company($this->DB,$request);
      $response= $employee->delete();
      return $response;
    }
}

 ?>
