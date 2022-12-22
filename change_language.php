<?php
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['lang']  = $_GET['lang'];
$lastPage = $_GET["lastPage"];
echo $_SESSION['lang'];
header('Location:' . $lastPage );
