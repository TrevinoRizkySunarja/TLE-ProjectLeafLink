<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['user'])) {
    header('Location: introscherm.php');
    exit;
}
?>
