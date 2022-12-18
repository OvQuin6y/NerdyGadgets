<?php
include "database.php";

$databaseConnection = connectToDatabase();

if (!isset($_SESSION)) {
    session_start();
}
if(!isset($_POST["goToIdeal"]) && !isset($_POST["goToIdeal2"])){
    header("Location: checkout.php");
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>iDeal bevestigingsscherm</title>
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
<h2 style="font-size:20px;">Amount to pay: €<?php echo round($_SESSION["totaalprijs"], 2) ?></h2>
<br>
<img src="Public/Img/iDeal.jpg" alt="iDeal logo">
<br>
<form method="post" action="paymentaccepted.php">
    <label style="font-size:20px;" for="bank">Choose your bank:</label>
    <select style="font-size:20px;" name="bank" id="bank">
        <option style="font-size:20px;" value="abnamro">ABN Amro</option>
        <option style="font-size:20px;" value="bunq">Bunq</option>
        <option style="font-size:20px;" value="ING">ING</option>
        <option style="font-size:20px;" value="moneyyou">MoneyYou</option>
        <option style="font-size:20px;" value="rabobank">Rabobank</option>
        <option style="font-size:20px;" value="sns">SNS</option>
        <option style="font-size:20px;" value="asn">ASN</option>
        <option style="font-size:20px;" value="knab">Knab</option>
    </select>
    <br><br><br>
    <input type="submit" value="Back" style="font-size: 17px;" fomaction="cart.php"
           class="form-submit-button">r
    <input type="submit" value="Pay" style="font-size: 17px;"
           class="form-submit-button">
</form>
</body>
</html>
<?php
if (isset($_POST["goToIdeal"])) {
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
} else {
    $_SESSION["fname"] = getCustomerData($databaseConnection,$_SESSION["klantID"],"FirstName");
    $_SESSION["lname"] = getCustomerData($databaseConnection,$_SESSION["klantID"],"LastName");
    $_SESSION["pcode"] = getCustomerData($databaseConnection,$_SESSION["klantID"],"PostalCode");
    $_SESSION["hnumber"] = getCustomerData($databaseConnection,$_SESSION["klantID"],"HouseNumber");
    $_SESSION["dpcode"] = getCustomerData($databaseConnection,$_SESSION["klantID"],"PostalCode");
    $_SESSION["daline1"] = getCustomerData($databaseConnection,$_SESSION["klantID"],"City");
    $_SESSION["daline2"] = getCustomerData($databaseConnection,$_SESSION["klantID"],"City");
    $_SESSION["paline1"] = getCustomerData($databaseConnection,$_SESSION["klantID"],"City");
    $_SESSION["paline2"] = getCustomerData($databaseConnection,$_SESSION["klantID"],"City");
    $_SESSION["pnumber"] = getCustomerData($databaseConnection,$_SESSION["klantID"],"PhoneNumber");
    $_SESSION["transactionOngoing"] = true;
}
?>