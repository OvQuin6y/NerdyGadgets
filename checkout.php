<!--de code voor de afrekenpagina-->
<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";
$totaalprijs = 0;
if(!isset($_SESSION['totaalprijs'])) {
    $_SESSION["totaalprijs"] = $totaalprijs;
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
    <h1 style="font-size:40px;">Order payment</h1><br>
    <table>
        <thead>
        <tr class="titles">
            <td>Name:</td>
            <td>Quantity:</td>
            <td>Price(incl. btw):</td>
            <td>ID:</td>
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
                height: 45px;
                width: 1000px;
                padding-left: 5%;
            }
        </style>
        <?php
        $cart = getCart();
        foreach ($cart as $nr => $aantal):
            $StockItem = getStockItem($nr, $databaseConnection);
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
                <td><h4><a href="<?= print("view.php?id=" . $nr) ?>"><?php echo $nr ?></a></h4></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <h3>Total price (incl. btw): €<?= number_format((float)$totaalprijs, 2, '.', '') ?></h3>
    <br><br>
</div>
<form method="post" action="ideal.php">
    <h3 style="font-size:40px;">Contact information: </h3>
    <label style="font-size:25px;" for="fname">First name:</label>
    <input type="text" id="fname" name="fname"><br><br>
    <label style="font-size:25px;" for="lname">Last name:</label>
    <input type="text" id="lname" name="lname"><br><br>
    <label style="font-size:25px;" for="pcode">Postal code:</label>
    <input type="text" id="pcode" name="pcode"><br><br>
    <label style="font-size: 25px;" for="hnumber">House number</label>
    <input type="number" id="hnumber" name="hnumber">
    <label style="font-size:25px;" for="address">Adress</label>
    <input type="text" id="address" name="address"><br><br>
    <input type="submit" value="To payment">
</form>
</body>
</html>
