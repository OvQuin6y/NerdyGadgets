<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

$databaseConnection = connectToDatabase();

if (!isset($_SESSION)) {
    session_start();
}

if (ISSET($_POST["login"]) && getPassword($databaseConnection,$_POST["mail"]) == $_POST["pword"]) {
    $_SESSION["klantID"] = getID($databaseConnection,$_POST["mail"]);
    ?>
    <script type="text/javascript">
        window.location.href = "index.php";
    </script>
    <?php
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
    <form method="post" action="login.php">
        <div class = "login_form">
            <input type="email" name="mail" placeholder="E-mail" class="loginfields" required>
            <input type="password" name="pword" placeholder="Password" class="loginfields" required>
        </div>
        <div class="Checkout_form">
            <input style="margin: 7px" type="submit" value="Back to website" href="javascript:history.go(-1)" class="Buttons_checkout">
            <input style="margin: 7px" type="submit" value="Log in" name="login" class="Buttons_checkout">
        </div>
        <h1 style="font-size:20px; text-align: center">Don't have an account? register <a href="register.php">here</a></h1>
        <?php
        if (ISSET($_POST["login"]) && getPassword($databaseConnection,$_POST["mail"]) <> $_POST["pword"]) {
            ?>
        <h1 style="font-size:20px; text-align: center; color: red;">Wrong password or e-mail</h1> <?php
            } ?>
    </form>
</div>
</body>

