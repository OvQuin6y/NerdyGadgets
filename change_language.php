<?php
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['lang']  = $_GET['lang'];
echo $_SESSION['lang'];
header('Location:index.php');
