<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db     = "Maryam FOUNDA";

$conn = new mysqli ($dbhost,$dbuser,$dbpass);

// check connection 

if($conn->connect_error){
    echo "Connection failed";
}






?>