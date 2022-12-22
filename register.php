<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

$lang = $_SESSION["lang"];
$databaseConnection = connectToDatabase();
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
    <h1><?php echo getTranslation($databaseConnection, $lang, "Registreren")?></h1>
</div>
<div class="loginContainer">
    <form class="loginForm" method="post" action="confirmation.php">
        <div class="loginInput">
        <input type="text" name="fname" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_voornaam") . " *" ?>" class = Inputfields required><br><br>
        <input type="text" name="lname" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_achternaam") . " *" ?>" class = Inputfields required><br><br>
        <input type="email" name="email" placeholder="<?php echo getTranslation($databaseConnection, $lang, "E-mail") . " *" ?>" class = Inputfields required><br><br>
        <input type="number" name="pnumber" placeholder="<?php echo getTranslation($databaseConnection, $lang, "telefoonnummer") . " *" ?>" class = Inputfields required><br><br>
        <input type="text" name="street" placeholder="<?php echo getTranslation($databaseConnection, $lang, "straatnaam") . " *" ?>" class = Inputfields required><br><br>
        <input type="number" name="hnumber" placeholder="<?php echo getTranslation($databaseConnection, $lang, "huisnummer") . " *" ?>" class = Inputfields required><br><br>
        <input type="text" name="city" placeholder="<?php echo getTranslation($databaseConnection, $lang, "woonplaats") . " *" ?>" class = Inputfields required><br><br>
        <input type="text" name="pcode" placeholder="<?php echo getTranslation($databaseConnection, $lang, "postcode") . " *" ?>" class = Inputfields required><br><br>
        <input type="text" name="apartment" placeholder="<?php echo getTranslation($databaseConnection, $lang, "apartement")?>" class = Inputfields><br><br>
        <input type="text" name="country" placeholder="<?php echo getTranslation($databaseConnection, $lang, "land") . " *" ?>" class = Inputfields required><br><br>
        <input type="password" name="pword" placeholder="<?php echo getTranslation($databaseConnection, $lang, "wachtwoord") . " *" ?>" class = Inputfields required><br><br>
        <input type="password" name="cpword" placeholder="<?php echo getTranslation($databaseConnection, $lang, "confirmeerwachtwoord") . " *" ?>" class = Inputfields required><br><br>
        </div>
        <div class="Checkout_form">
        <input type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "terugnaarwebsite")?>" style="font-size: 17px;" formaction="index.php" class="Buttons_checkout" formnovalidate><br>
        <input type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "registreren")?>" style="font-size: 17px;" name="register" class="Buttons_checkout"><br><br>
        </div>
    </form>
    <h1 style="font-size:20px; text-align: center"><?php echo getTranslation($databaseConnection, $lang, "aleenaccount")?><a href="login.php"><?php echo " ".getTranslation($databaseConnection, $lang, "hier")?></a></h1>
</div>
</body>

