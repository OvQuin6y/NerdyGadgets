<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>orderlogin</title>
    <link rel="stylesheet" href="Public/CSS/cart.css">
</head>
<body>
<h1 style="text-align: center;">Login</h1>
<form method="post" action="checkout.php" class="container">
<div class="loginField">
    <input type="text" name="mail" placeholder="E-mail" required>
    <input type="password" name="pword" placeholder="Password" required>
</div>
<div>
    <input type="submit" value="Login" name="login">
</div>
</form>
</body>