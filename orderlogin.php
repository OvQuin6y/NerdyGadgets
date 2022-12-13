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
    <h1>Login</h1>
</div>
<div class="container">
    <form method="post" action="checkout.php">
        <div class = "login_form">
        <input type="email" name="mail" placeholder="E-mail" class="loginfields" required>
        <input type="password" name="pword" placeholder="Password" class="loginfields" required>
        </div>
        <div class="Checkout_form">
        <input style="margin: 7px" type="submit" value="Back to cart" href="cart.php" class="Buttons_checkout">
        <input style="margin: 7px" type="submit" value="Log in" class="Buttons_checkout">
        </div>
    </form>
    <div class="Checkout_form">
        <button style="font-size: 20px; margin: 7px" href="checkout.php" class="Buttons_checkout">Continue without account</button>
        <button style="font-size: 20px; margin: 7px" href="register.php" class="Buttons_checkout">Register</button>
    </div>
</div>
</body>
