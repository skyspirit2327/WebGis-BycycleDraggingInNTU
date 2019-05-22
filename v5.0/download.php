<?php
/*
$weekday = $_POST['weekday'];
$inDay = $_POST['inDay'];
$month = $_POST['month'];
*/


function runmyfunction(){
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
  echo "Connected successfully </br>";
  
}catch(PDOException $e)
{
  echo "database connection failed: ({$db_servername}:{$db_port})\n {$e->getMessage()}";
  exit;
}



// type in sql query needs change
$sql="SELECT * FROM bike_test";

$prepare=$conn->prepare($sql);
//$prepare->bindValue(':stype','地下車站');
$prepare->execute();                           //$conn->query($sql), SQL injection
$result=$prepare->fetchAll();

$json_result=json_encode($result,JSON_UNESCAPED_UNICODE);


// This prints out all data got from db
/*
if(is_array($result)){
  foreach($result as $rs)
  	echo "{$rs['Datee']},{$rs['Timee']},{$rs['Location']},{$rs['Latitude']},{$rs['Longitude']},{$rs['Date_time']}</br>";

	}
*/
//success

// download file used 
header('Content-Type: application/json;charset=utf-8');
header('Content-Disposition:attachment;filename=Download.json');
echo $json_result;
$conn=null;
}


if(isset($_GET['hello'])){
  runMyFunction();
}




?>