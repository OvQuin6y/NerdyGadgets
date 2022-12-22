<!--de code voor de afrekenpagina-->
<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

$totaalprijs = 0;

if (isCardEmpty()) {
    ?>
<script type="text/javascript">
    window.location.href = "cart.php";
</script>

    <?php
}

$lang = $_SESSION["lang"];
$databaseConnection = connectToDatabase();

if (!isset($_SESSION['totaalprijs'])) {
    $_SESSION["totaalprijs"] = $totaalprijs;
}

if (isset($_POST["login"]) && getPassword($databaseConnection, $_POST["mail"]) == $_POST["pword"]) {
    $_SESSION["klantID"] = getID($databaseConnection, $_POST["mail"]);
    echo "<meta http-equiv='refresh' content='0'>";
}


?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title><?php echo getTranslation($databaseConnection, $lang, "Checkout_paginatitel") ?></title>
    <link rel="stylesheet" href="Public/CSS/cart.css">
</head>
<body>
<div class="maincontainer">
    <h1 style="font-size:40px;"><?php echo getTranslation($databaseConnection, $lang, "Checkout_titel_overzicht") ?></h1>
    <br>
    <table>
        <thead><br>
        <tr class="titles">
            <td><?php echo getTranslation($databaseConnection, $lang, "Winkelmandje_en_checkout_overzicht_naam") . ":" ?></td>
            <td><?php echo getTranslation($databaseConnection, $lang, "Winkelmandje_en_checkout_overzicht_aantal") . ":" ?></td>
            <td><?php echo getTranslation($databaseConnection, $lang, "Checkout_overzicht_kop_prijs_extra") . ":" ?></td>
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
            if (isset($_SESSION['totaalprijs'])) {
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
    <h3><?php echo getTranslation($databaseConnection, $lang, "Winkelmandje_en_checkout_totaalprijs") . ": €" ?><?= number_format((float)$totaalprijs, 2, '.', '') ?></h3>
    <br><br>
</div>
<?php
?>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<div class="Invoer_form">
    <h4 class = "Text_checkout"><?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_titel")?></h4><br>
    <?php if (isset($_SESSION["klantID"])) { ?>

        <table style="display: flex; justify-content: space-around; margin-left: 15vh">
            <Tr>
                <td><?php echo getTranslation($databaseConnection, $lang, "naam").": "?></td>
                <td><?php echo getCustomerData($databaseConnection,$_SESSION["klantID"],"FirstName")." ".getCustomerData($databaseConnection,$_SESSION["klantID"],"LastName")?></td>
            </Tr>
            <tr>
                <td><?php echo getTranslation($databaseConnection, $lang, "E-mail").": "?></td>
                <td><?php echo getCustomerData($databaseConnection,$_SESSION["klantID"],"Email")?></td>
            </tr>
            <tr>
                <td><?php echo getTranslation($databaseConnection, $lang, "telefoonnummer").": "?></td>
                <td><?php echo getCustomerData($databaseConnection,$_SESSION["klantID"],"PhoneNumber")?></td>
            </tr>
            <tr>
                <td><?php echo getTranslation($databaseConnection, $lang, "adres").": "?></td>
                <td><?php echo getCustomerData($databaseConnection,$_SESSION["klantID"],"Street")." ".getCustomerData($databaseConnection,$_SESSION["klantID"],"HouseNumber").", ".getCustomerData($databaseConnection,$_SESSION["klantID"],"PostalCode")." ".getCustomerData($databaseConnection,$_SESSION["klantID"],"City")?></td>
            </tr>
            <tr>
                <td><?php echo getTranslation($databaseConnection, $lang, "land").": "?></td>
                <td><?php echo getCustomerData($databaseConnection,$_SESSION["klantID"],"Country")?></td>
            </tr>
        </table>

        <form class="Checkout_form" style="padding-left: 0" method="post" action="ideal.php">
            <input type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_knop_naar_winkelmand") ?>" style="font-size: 17px; width: 27vh;" formaction="cart.php" class="Buttons_checkout" formnovalidate><br>
            <input type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_knop_naar_iDeal") ?>" style="font-size: 17px; width: 27vh;" name="goToIdeal2" class="Buttons_checkout"><br><br>
        </form>
    <?php } else { ?>
        <form class = "Checkout_form" method="post" action="ideal.php">
            <input type="text" id="fname" name="fname" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_voornaam") . " *" ?>" class = Inputfields required><br><br>
            <input type="text" id="lname" name="lname" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_achternaam") . " *" ?>" class = Inputfields required><br><br>
            <input type="text" id="dpcode" name="dpcode" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_bezorg_postcode") . " *" ?>" class = Inputfields required><br><br>
            <input type="text" id="pcode" name="pcode" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_postcode") . " *" ?>" class = Inputfields required><br><br>
            <input type="number" id="hnumber" name="hnumber" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_huisnummer") . " *" ?>" class = Inputfields required><br><br>
            <input type="text" id="city" name="city" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_stad") . " *" ?>" class = Inputfields required><br><br>
            <input type="email" id="e-mail" name="e-mail" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_e-mail") . " *" ?>" class = Inputfields required><br><br>
            <input type="number" id="pnumber" name="pnumber" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_telefoonnummer") . " *" ?>" class = Inputfields required><br><br>
            <input type="text" id="daline1" name="daline1" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_bezorgadres") . "*"?>" class = Inputfields required><br><br>
            <input type="text" id="daline2" name="daline2" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_bezorgadres_toevoeging") ?>" class = Inputfields><br><br>
            <input type="text" id="paline1" name="paline1" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_postadres") . " *" ?>" class = Inputfields required><br><br>
            <input type="text" id="paline2" name="paline2" placeholder="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_postadres_toevoeging") ?>" class = Inputfields><br><br>
            <input type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_knop_naar_winkelmand") ?>" style="font-size: 17px;" formaction="cart.php" class="Buttons_checkout" formnovalidate><br>
            <input type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "Persoonsgegevens_knop_naar_iDeal") ?>" style="font-size: 17px;" name="goToIdeal" class="Buttons_checkout"><br><br>
        </form>
    <?php } ?>
</div>
</div>
</body>
</html>