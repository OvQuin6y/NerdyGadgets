<!--de code voor de afrekenpagina-->
<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

$totaalprijs = 0;
$databaseConnection = connectToDatabase();

if(!isset($_SESSION['totaalprijs'])) {
    $_SESSION["totaalprijs"] = $totaalprijs;
}

if(isCardEmpty()) {
    header("Location: index.php");
}

if (ISSET($_POST["login"]) && getPassword($databaseConnection,$_POST["mail"]) == $_POST["pword"]) {
    $_SESSION["klantID"] = getID($databaseConnection,$_POST["mail"]);
    echo "<meta http-equiv='refresh' content='0'>";
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Afrekenen bestelling</title>
    <link rel="stylesheet" href="Public/CSS/cart.css">
</head>
<body>
<div class="maincontainer">
    <h1 style="font-size:40px;">Order summary</h1><br>
    <table>
        <thead><br>
        <tr class="titles">
            <td>Name:</td>
            <td>Quantity:</td>
            <td>Price per product (incl. btw):</td>
        </tr>
        </thead>
        <tbody class="bodycontainer">
        <style>
            .container {
                margin-left: 0;
            }

            tbody {
                display: block;
                max-height: 500px;
            }

            thead,
            tbody tr {
                display: table;
                width: 100%;
            }

            thead {
                width: 100%;
            }

            table {
                width: 1300px;
            }

            td:nth-child(1) {
                width: 34%
            }

            td:nth-child(3) {
                width: 34%
            }
            form {
                height: 20px;
                width: 900px;
                padding-left: 5%;
            }
            h3 {
                text-align: right;
            }
        </style>
        <?php
        $cart = getCart();
        foreach ($cart as $nr => $aantal):
            $StockItem = getStockItem($nr, $databaseConnection, $_SESSION["lang"]);
            $stockItemImage = getStockItemImage($nr, $databaseConnection);
            $totaalprijs += $cart[$nr] * $StockItem['SellPrice'];
            if(isset($_SESSION['totaalprijs'])) {
                $_SESSION["totaalprijs"] = $totaalprijs;
            }
            ?>
            <tr class="data">
                <td><h6><?= $StockItem['StockItemName'] ?></h6></td>
                <td><h4><?= $cart[$nr] ?></h4></td>
                <td><h4>€<?= number_format((float)$StockItem['SellPrice'], 2, '.', '') ?></h4></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <h3>Total price (VAT included): €<?= number_format((float)$totaalprijs, 2, '.', '') ?></h3>
    <br><br>
</div>
<?php
?>
<script>
    if (window.history.replaceState ) {
        window.history.replaceState(null, null, window.location.href );
    }
</script>
<div class="Invoer_form"></div>
    <h4 class = "Text_checkout">Contact information: </h4>
    <?php if (isset($_SESSION["klantID"])) { ?>
        <table style="display: flex; justify-content: space-around; margin-left: 32vh">
            <Tr>
                <td>Name:</td>
                <td><?php echo getCustomerData($databaseConnection,$_SESSION["klantID"],"FirstName")." ".getCustomerData($databaseConnection,$_SESSION["klantID"],"LastName")?></td>
            </Tr>
            <tr>
                <td>E-maiL:</td>
                <td><?php echo getCustomerData($databaseConnection,$_SESSION["klantID"],"Email")?></td>
            </tr>
            <tr>
                <td>Phone Number:</td>
                <td><?php echo getCustomerData($databaseConnection,$_SESSION["klantID"],"PhoneNumber")?></td>
            </tr>
            <tr>
                <td>Adress:</td>
                <td><?php echo getCustomerData($databaseConnection,$_SESSION["klantID"],"Street")." ".getCustomerData($databaseConnection,$_SESSION["klantID"],"HouseNumber").", ".getCustomerData($databaseConnection,$_SESSION["klantID"],"PostalCode")." ".getCustomerData($databaseConnection,$_SESSION["klantID"],"City")?></td>
            </tr>
            <tr>
                <td>Country:</td>
                <td><?php echo getCustomerData($databaseConnection,$_SESSION["klantID"],"Country")?></td>
            </tr>
        </table>
        <form class="Checkout_form" style="padding-left: 0" method="post" action="ideal.php">
            <input type="submit" value="Confirm and continue" style="font-size: 17px; width: 20vh" name="goToIdeal2" class="Buttons_checkout"><br><br>
        </form>
    <?php } else { ?>
        <form class = "Checkout_form" method="post" action="ideal.php">
                <input type="text" id="fname" name="fname" placeholder="First name" class = Inputfields required><br><br>
                <input type="text" id="lname" name="lname" placeholder="Last name" class = Inputfields required><br><br>
                <input type="text" id="dpcode" name="dpcode" placeholder="Delivery postal code" class = Inputfields required><br><br>
                <input type="text" id="pcode" name="pcode" placeholder="Postal code" class = Inputfields required><br><br>
                <input type="number" id="hnumber" name="hnumber" placeholder="House number" class = Inputfields required><br><br>
                <input type="text" id="city" name="city" placeholder="City" class = Inputfields required><br><br>
                <input type="email" id="e-mail" name="e-mail" placeholder="e.g Example@windesheim.nl" class = Inputfields required><br><br>
                <input type="number" id="pnumber" name="pnumber" placeholder="Phone number" class = Inputfields required><br><br>
                <input type="text" id="daline1" name="daline1" required placeholder="Delivery Address" class = Inputfields><br><br>
                <input type="text" id="daline2" name="daline2" placeholder="Apartment, suite, etc. (Optional)" class = Inputfields><br><br>
                <input type="text" id="paline1" name="paline1" placeholder="Postal address" class = Inputfields required><br><br>
                <input type="text" id="paline2" name="paline2" placeholder="(Optional) Postal address 2" class = Inputfields><br><br>
                <input type="submit" value="Back to shopping cart" style="font-size: 17px;" href="cart.php" class="Buttons_checkout" formnovalidate><br>
                <input type="submit" value="Confirm and continue" style="font-size: 17px;" name="goToIdeal" class="Buttons_checkout"><br><br>
        </form>
    <?php } ?>
</div>
</body>
</html>