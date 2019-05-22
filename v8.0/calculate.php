<?php

/*
location
timeNow
stopTime
cancelBtn
confirmBtn

*/

$location = $_POST['location'];
$timeNow = $_POST['timeNow'];
$goTime = $_POST['goTime'];

/*
echo $location;
echo $timeNow ;
echo $goTime;
*/

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

/*
分子：那個點在那個時間被拖的天數
select count(distinct(datee))
from  bicycle.bike
where (Timee>='10:00' and Timee<='18:00') and Location='大一女'

分母：所有天數
select count(distinct(datee))
from bicycle.bike

10:00:00
18:00:00
*/

$Towing ='SELECT COUNT(DISTINCT(datee))
          FROM bike
          WHERE location=\''.$location.'\' and (timee>=\''.$timeNow.'\' and timee <=\''.$goTime.'\')';


$ALL = 'SELECT COUNT(DISTINCT(datee))
        FROM bike';

$Towing = $conn->query($Towing);
$ALL = $conn->query($ALL);

$Towing  = $Towing ->fetch(PDO::FETCH_NUM );
$ALL  = $ALL ->fetch(PDO::FETCH_NUM );

$probability = (string) number_format((($Towing[0]/$ALL[0])*100),2);
$probability = $probability.'%';

echo  $probability ;


?>