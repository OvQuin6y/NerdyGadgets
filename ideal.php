<?php
include "languageFunctions.php";
include "database.php";

if (!isset($_SESSION)) {
    session_start();
}

$lang = $_SESSION["lang"];
$databaseConnection = connectToDatabase();

if(!isset($_POST["goToIdeal"])){
    header("Location: checkout.php");
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title><?php echo getTranslation($databaseConnection, $lang, "Betaalpagina_paginatitel")?></title>
</head>
<body style="background-color:#FFFFFF;">
<style>
    h1 {
        text-align: center;
    }

    h2 {
        margin: auto;
        width: 45%
    }

    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 10%;
    }

    form {
        text-align: center;
    }

    .form-submit-button {
        background: #FFA500;
        color: white;
        border-style: outset;
        border-color: #FFA500;
        border-radius:         height: 45px;
        12px;
        width: 100px;
    }
</style>
<br>
<h1 style="font-size:200px;"></h1>
<h2 style="font-size:20px;"><?php echo getTranslation($databaseConnection, $lang, "Betaalpagina-totaalprijs"). ": €" .  round($_SESSION["totaalprijs"], 2) ?></h2>
<br>
<img src="Public/Img/iDeal.jpg" alt="iDeal logo">
<br>
<form method="post" action="paymentaccepted.php">
    <label style="font-size:20px;" for="bank"><?php echo getTranslation($databaseConnection, $lang, "Betaalpagina-keuze_bank") . ":"?></label>
    <select style="font-size:20px;" name="bank" id="bank">
        <option style="font-size:20px;" value="abnamro"><?php echo getTranslation($databaseConnection, $lang, "Betaalpagina_bank_ABN-Amro") ?></option>
        <option style="font-size:20px;" value="bunq"><?php echo getTranslation($databaseConnection, $lang, "Betaalpagina_bank_Bunq") ?></option>
        <option style="font-size:20px;" value="ING"><?php echo getTranslation($databaseConnection, $lang, "Betaalpagina_bank_ING") ?></option>
        <option style="font-size:20px;" value="moneyyou"><?php echo getTranslation($databaseConnection, $lang, "Betaalpagina_bank_MoneyYou") ?></option>
        <option style="font-size:20px;" value="rabobank"><?php echo getTranslation($databaseConnection, $lang, "Betaalpagina_bank_Rabobank") ?></option>
        <option style="font-size:20px;" value="sns"><?php echo getTranslation($databaseConnection, $lang, "Betaalpagina_bank_SNS") ?></option>
        <option style="font-size:20px;" value="asn"><?php echo getTranslation($databaseConnection, $lang, "Betaalpagina_bank_ASN") ?></option>
        <option style="font-size:20px;" value="knab"><?php echo getTranslation($databaseConnection, $lang, "Betaalpagina_bank_Knab") ?></option>
    </select>
    <br><br><br>
    <input type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "Betaalpagina_knop_terug") ?>" style="font-size: 17px;" formaction="cart.php"
           class="form-submit-button">
    <input type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "Betaalpagina_knop_betaal") ?>" style="font-size: 17px;"
           class="form-submit-button">
</form>
</body>
</html>
<?php
if(isset($_POST["goToIdeal"])){
    $_SESSION["fname"] = $_POST["fname"];
    $_SESSION["lname"] = $_POST["lname"];
    $_SESSION["pcode"] = $_POST["pcode"];
    $_SESSION["hnumber"] = $_POST["hnumber"];
    $_SESSION["dpcode"] = $_POST["dpcode"];
    $_SESSION["daline1"] = $_POST["daline1"];
    $_SESSION["daline2"] = $_POST["daline2"];
    $_SESSION["paline1"] = $_POST["paline1"];
    $_SESSION["paline2"] = $_POST["paline2"];
    $_SESSION["pnumber"] = $_POST["pnumber"];
    $_SESSION["e-mail"] = $_POST["e-mail"];
    $_SESSION["transactionOngoing"] = true;
}
?>