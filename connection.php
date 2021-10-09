<?php
$servername='localhost';
$username='root';
$password='';
$dbname = "test";
$db=mysqli_connect($servername,$username,$password,"$dbname");
if(!$db){
   die('Could not Connect My Sql:' .mysql_error());
}
?>