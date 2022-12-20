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

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $pnumber = $_POST["pnumber"];
    $pcode = $_POST["pcode"];
    $city = $_POST["city"];
    $hnumber = $_POST["hnumber"];
    $apartment = $_POST["apartment"];
    $pword = $_POST["pword"];
    $country = $_POST["country"];
    $street = $_POST["street"];
}
$register = $databaseConnection->prepare("INSERT INTO klant(FirstName,LastName,Email,PhoneNumber,PostalCode,City,HouseNumber,Apartment,Password,Street,Country)
    VALUES (?,?,?,?,?,?,?,?,?,?,?)");
$register->bind_param("sssississsss",$fname,$lname,$email,$pnumber,$pcode,$city,$hnumber,$apartment,$pword,$street,$country);
$register->execute();
