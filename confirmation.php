<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

$databaseConnection = connectToDatabase();

if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>register</title>
    <link rel="stylesheet" href="Public/CSS/style.css">
</head>
<body>
<div class="registerTitle">
    <h1>Your registration was succesfull!</h1>
</div>


