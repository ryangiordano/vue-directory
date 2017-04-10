<?php
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Credentials: true");
 header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
 header('Access-Control-Max-Age: 1000');
 header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
 header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$host = 'localhost:3333';//this is the host for codigo
// $host='localhost:3306';//this is the host for my home
$user='root';
$password='root';
$dbName='test';
$charset = 'utf8';

// $host = 'localhost';
// $user='root';
// $password='MyNewPass';
// $dbName='test';
// $charset = 'utf8';

$dsn = "mysql:host=$host;dbname = $dbName;charset=$charset";
$opt = array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false);

$DB = new PDO($dsn, $user, $password, $opt);
 ?>
