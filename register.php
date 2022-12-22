<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

$databaseConnection = connectToDatabase();

if (isset($_POST["register"]) && checkMail($databaseConnection,$_POST["email"]) == "FALSE") {
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
    $register = $databaseConnection->prepare("INSERT INTO klant(FirstName,LastName,Email,PhoneNumber,PostalCode,City,HouseNumber,Apartment,Password,Street,Country)
    VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    $register->bind_param("sssississss",$fname,$lname,$email,$pnumber,$pcode,$city,$hnumber,$apartment,$pword,$street,$country);
    $register->execute();
    header("Location: confirmation.php");
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
    <h1>register</h1>
</div>
<div class="container">
    <form class = "Checkout_form" method="post" action="register.php">
        <input type="text" name="fname" placeholder="First name" class = Inputfields required><br><br>
        <input type="text" name="lname" placeholder="Last name" class = Inputfields required><br><br>
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
    <?php if (isset($_POST["register"]) && checkMail($databaseConnection,$_POST["email"]) == "TRUE") {?>
        <h1 style="font-size:20px; text-align: center; color: red;">That E-mail is already in use</h1>
    <?php } ?>
</div>
</body>

