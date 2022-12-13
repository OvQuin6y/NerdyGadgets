<?php
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['lang']  = $_GET['lang'];
header('Location:index.php');
echo $_SESSION['lang'];
?>