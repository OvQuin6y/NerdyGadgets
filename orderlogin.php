<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

$databaseConnection = connectToDatabase();

if (!isset($_SESSION)) {
    session_start();
}

if (ISSET($_SESSION['klantID'])) {
    header("Location: checkout.php");
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
    <h1>Login</h1>
</div>
<div class="container">
    <form method="post" action="checkout.php">
        <div class = "login_form">
        <input type="email" name="mail" placeholder="E-mail" class="loginfields" required>
        <input type="password" name="pword" placeholder="Password" class="loginfields" required>
        </div>
        <div class="Checkout_form">
        <input style="margin: 7px" type="submit" value="Back to cart" formaction="cart.php" class="Buttons_checkout" formnovalidate>
        <input style="margin: 7px" type="submit" value="Log in" name="login" class="Buttons_checkout">
        <input style="margin: 7px" type="submit" value="Continue without account" formaction="checkout.php" class="Buttons_checkout" formnovalidate>
        <input style="margin: 7px" type="submit" value="Register" formaction="register.php" class="Buttons_checkout" formnovalidate>
        </div>
    </form>
    <?php
    if (ISSET($_POST["login"]) && getPassword($databaseConnection,$_POST["mail"]) <> $_POST["pword"]) {
        ?>
        <h1 style="font-size:20px; text-align: center; color: red;">Wrong password or e-mail</h1> <?php
    } ?>
</div>
</body>
