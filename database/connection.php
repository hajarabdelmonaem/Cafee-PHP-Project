<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "cafeedb";

// Create connection
$connect = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
} 
//    echo "Connected successfully";

