<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>iDeal bevestiginsscherm</title>
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
        border-radius: 12px;
        height: 45px;
        width: 100px;
    }
</style>
<br>
<h1 style="font-size:200px;"></h1>
<h2 style="font-size:20px;">Te betalen bedrag: €</h2>
<br>
<img src="iDeal.jpg" alt="iDeal logo">
<br>
<form method="post" action="betalingvoltooid.php">
    <label style="font-size:20px;" for="bank">Kies je bank:</label>
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
    <input type="submit" value="Terug" style="font-size: 17px;" href="http://localhost/NerdyGadgets/cart.php" class="form-submit-button">
    <form method="post" action="cart.php">
        <input type="submit" value="Afrekenen" style="font-size: 17px;" href="http://localhost/NerdyGadgets/ideal.php"
               class="form-submit-button">
    </form>
</form>
</body>
</html>