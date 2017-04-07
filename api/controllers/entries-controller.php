<?php
require_once '../model/entry-model.php';
//Route takes requests and tells controller what to do.
//Controller handles firing functions as directed from the route.
//The model interfaces with the database and returns data;

class EntriesController
{
  function __construct($DB)
  {
    $this->DB = $DB;
  }
    public function postEntry($request)
    {
      //instantiate an entry model
      $entry = new Entry($this->DB,$request);
      $response = $entry->save();
      echo $response;
    }
    public function getAll()
    {
      $entry = new Entry($this->DB);
      $response = $entry->get();
      return $response;
    }
    public function getEntry($id)
    {
      $entry = new Entry($this->DB);
      $response = $entry->getOne($id);
      return $response;
    }
    public function editUser(){
      $entry = new Entry($this->DB, array(
        "firstName"=>"Andy",
        "lastName"=>"Levenson",
        "img"=>"https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Doughnut-1023029-m-1.jpg/220px-Doughnut-1023029-m-1.jpg"
      ));
      $response = $entry->edit($id);
    }
    public function deleteEntry($id)
    {
      $entry= new Entry($this->DB);
      $response= $entry->delete($id);
      return $response;
    }
}

 ?>
