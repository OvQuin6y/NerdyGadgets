<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

$databaseConnection = connectToDatabase();

if (!isset($_SESSION)) {
    session_start();
}

if (ISSET($_SESSION['klantID'])) {
    ?>
    <script type="text/javascript">
        window.location.href = "checkout.php";
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
<div class="loginContainer">
    <form method="post" action="checkout.php" class="loginForm">
        <div class = "loginInput">
        <input type="email" name="mail" placeholder="<?php echo getTranslation($databaseConnection, $lang, "E-mail")?>" class="loginfields" required>
        <input type="password" name="pword" placeholder="<?php echo getTranslation($databaseConnection, $lang, "wachtwoord")?>" class="loginfields" required>
        </div>
        <div class="Checkout_form">
        <input type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_knop_naar_winkelmand")?>" formaction="cart.php" class="Buttons_checkout" formnovalidate>
        <input type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "inloggen")?>" name="login" class="Buttons_checkout">
        <input type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "zonderacount")?>" formaction="checkout.php" class="Buttons_checkout" formnovalidate>
        <input type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "registreren")?>" formaction="register.php" class="Buttons_checkout" formnovalidate>
        </div>
    </form>
    <?php
    if (ISSET($_POST["login"]) && getPassword($databaseConnection,$_POST["mail"]) <> $_POST["pword"]) {
        ?>
        <h1 style="font-size:20px; text-align: center; color: red;">Wrong password or e-mail</h1> <?php
    } ?>
</div>
</body>
