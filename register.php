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
    <form class = "Checkout_form" method="post" action="confirmation.php">
        <input type="text" name="fname" placeholder="First name" class = Inputfields required><br><br>
        <input type="text" name="lname" placeholder="Last name" class = Inputfields required><br><br>
        <input type="email" name="email" placeholder="E-mail" class = Inputfields required><br><br>
        <input type="number" name="pnumber" placeholder="Phone number" class = Inputfields required><br><br>
        <input type="text" name="pcode" placeholder="Postal code" class = Inputfields required><br><br>
        <input type="text" name="city" placeholder="City" class = Inputfields required><br><br>
        <input type="number" name="hnumber" placeholder="House number" class = Inputfields required><br><br>
        <input type="text" name="apartment" placeholder="Apartment/suite (opt.)" class = Inputfields><br><br>
        <input type="password" name="pword" placeholder="Password" class = Inputfields required><br><br>
        <input type="password" name="cpword" placeholder="Confirm password" class = Inputfields required><br><br>
        <input type="submit" value="Cancel" style="font-size: 17px;" href="index.php" class="Buttons_checkout"><br>
        <input type="submit" value="Register" style="font-size: 17px;" name="register" class="Buttons_checkout"><br><br>
    </form>
    <h1 style="font-size:20px; text-align: center">Already have an account? log in <a href="login.php">here</a></h1>
</div>
</body>

