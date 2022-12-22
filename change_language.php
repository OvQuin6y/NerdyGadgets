<?php
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['lang']  = $_GET['lang'];
$lastPage = $_GET["lastPage"];
header('Location:' . $lastPage );
