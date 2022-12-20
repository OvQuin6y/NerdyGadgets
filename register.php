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
    <h1>register</h1>
</div>
<div class="container">
    <form class = "Checkout_form" method="post" action="confirmation.php">
        <input type="text" name="fname" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_voornaam") . " *" ?>" class = Inputfields required><br><br>
        <input type="text" name="lname" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_achternaam") . " *" ?>" class = Inputfields required><br><br>
        <input type="email" name="email" placeholder="E-mail" class = Inputfields required><br><br>
        <input type="number" name="pnumber" placeholder="Phone number" class = Inputfields required><br><br>
        <input type="text" name="street" placeholder="Street name" class = Inputfields required><br><br>
        <input type="number" name="hnumber" placeholder="House number" class = Inputfields required><br><br>
        <input type="text" name="city" placeholder="City" class = Inputfields required><br><br>
        <input type="text" name="pcode" placeholder="Postal code" class = Inputfields required><br><br>
        <input type="text" name="apartment" placeholder="Apartment/suite (opt.)" class = Inputfields><br><br>
        <input type="text" name="country" placeholder="Country" class = Inputfields required><br><br>
        <input type="password" name="pword" placeholder="Password" class = Inputfields required><br><br>
        <input type="password" name="cpword" placeholder="Confirm password" class = Inputfields required><br><br>
        <input type="submit" value="Back to website" style="font-size: 17px;" formaction="index.php" class="Buttons_checkout" formnovalidate><br>
        <input type="submit" value="Register" style="font-size: 17px;" name="register" class="Buttons_checkout"><br><br>
    </form>
    <h1 style="font-size:20px; text-align: center">Already have an account? log in <a href="login.php">here</a></h1>
</div>
</body>

