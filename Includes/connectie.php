<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "leaflinkk";

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: " . mysqli_connect_error());;