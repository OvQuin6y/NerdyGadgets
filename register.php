<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";
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
    <h1>register</h1>
</div>
<div class="container">
<form method="post" action="confirmation.php">
    <table>
        <div class="invoer">
            <input type="text" id="fname" name="fname" placeholder="First name" required>
            <input type="text" id="lname" name="lname" placeholder="Last name" required>
        </div>
        <div class="invoer">
            <input type="text" id="mail" name="mail" placeholder="E-mail" required>
            <input type="text" id="phone" name="phone" placeholder="Phone number" required>
        </div>
        <div class="invoer">
            <input type="text" id="pcode" name="pcode" placeholder="Postal code" required>
            <input type="text" id="city" name="city" placeholder="City" required>
        </div>
        <div class="invoer">
            <input type="text" id="hnumber" name="hnumber" placeholder="House number" required>
            <input type="text" id="apartment" name="apartment" placeholder="Apartment/suite (opt.)">
        </div>
        <div class="invoer">
            <input type="text" id="password" name="password" placeholder="Password" required>
            <input type="text" id="cpassword" name="cpassword" placeholder="Confirm password">
        </div>
        <div class="invoer">
            <input class="submitRegistration" type="submit" value="Continue" name="confirmRegistration">
        </div>
    </table>
</form>
</div>
</body>

