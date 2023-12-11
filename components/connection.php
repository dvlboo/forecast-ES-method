<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'db_forecast'; 

$connection = mysqli_connect($server, $username, $password, $database);
if (!$connection){
    die("Connection Failed:".mysqli_connect_error());
}