<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "iteh1";
global $conn;
        $conn= new mysqli($server, $user, $password, $database);
if ($conn->connect_errno) {
    printf("Connection failed: %s\n", $conn->connect_error);
    exit();
}
$conn->set_charset("utf8");
