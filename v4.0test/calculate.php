<?php

// get ajax request 
// month ,day, time

$location = $_POST['location'];
$timeNow = $_POST['timeNow'];
$stopTime = $_POST['stopTime'];


$db_servername = "127.0.0.1";     //localhost
$db_username = "justin";
$db_password = "justin0919";
$db_database = "bicycle";
$db_port = "3306"; 


try{
  $conn = new PDO("mysql:host={$db_servername};port={$db_port};dbname={$db_database}", 
                  $db_username, 
                  $db_password,
                  array(
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'  //important
                  )
                 );
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully </br>";
  
}catch(PDOException $e)
{
  //echo "database connection failed: ({$db_servername}:{$db_port})\n {$e->getMessage()}";
  exit;
}

$ALL = 'SELECT COUNT(*), Longitude AS x, Latitude AS y FROM bike_test WHERE time>='.$timeNow.',time<='.$stopTime;
$Towing = 'SELECT COUNT(*), Longitude AS x, Latitude AS y FROM bike_test WHERE location='.$location.',time>='.$timeNow.',time=<'.$stopTime;
$Probability = $Towing / $ALL
$rs = $conn->query($sql);
/*
if (!$rs) {
    echo 'An SQL error occured.\n';
    exit;
}
*/



echo $Probability ;




?>