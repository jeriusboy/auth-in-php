<?php
 
 function databaseConnection(){ 
    $servername = "localhost";      
    $username = "root";
    $password = "";
    $dbname = "auth_php";

    $db_connect = mysqli_connect($servername, $username, $password, $dbname);

    if($db_connect->connect_error){
        die("Connection failed: " . $db_connect->connect_error);
    }
    return $db_connect;
 }
?>