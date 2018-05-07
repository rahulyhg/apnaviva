<?php

$hostname='localhost';
$username='root';
$password='';
$dbname='year';

$connection=mysqli_connect($hostname,$username,$password,$dbname);

if(!$connection){
  die("Connection failed ".mysqli_error($connection));
}

 ?>
