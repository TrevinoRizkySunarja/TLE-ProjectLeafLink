<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "leaflink";

//$host = "stud.hosted.hr.nl";
//$user = "0998374";
//$password = "gaeleeph";
//$database = "prj_2025_2026_tle1_t6";

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: " . mysqli_connect_error());;