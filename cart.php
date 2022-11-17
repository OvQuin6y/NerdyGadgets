<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";
$totaalPrijs = 0;
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen</title>
    <link rel="stylesheet" href="Public/CSS/cart.css">
</head>
<body>
<div class="maincontainer">
    <h1>Inhoud Winkelwagen</h1>
    <table>
        <thead>
        <tr class="titles">
            <td>Image:</td>
            <td>Name:</td>
            <td>Quantity:</td>
            <td>Price(incl. btw):</td>
            <td>ID:</td>
            <td></td>
        </tr>
        </thead>
        <tbody class="bodycontainer">
        <?php
        $cart = getCart();
        foreach ($cart as $nr => $aantal):
            $stockItem = getStockItem($nr, $databaseConnection);
            $stockItemImage = getStockItemImage($nr, $databaseConnection);
            $totaalPrijs += $aantal * $stockItem['SellPrice'];
            if (ISSET($_GET[$nr])) {
                addProductToCart($nr);
                unset($_GET[$nr]);
            }
            if (ISSET($_GET[$nr."-"])) {
                removeProductFromCart($nr);
                unset($_GET[$nr."-"]);
            }
            if (ISSET($_GET["del".$nr])) {
                deleteProductFromCart($nr);
                unset($_GET["del".$nr]);
            }
            ?>
            <tr class="data">
                <td>
                    <img src="Public/StockItemIMG/<?php if (!empty($stockItemImage) ? print($stockItemImage[0]['ImagePath']) : print 'error.png') ?>">
                </td>
                <td><h6><?= $stockItem['StockItemName'] ?></h6></td>
                <td><h4><a href="cart.php?<?php echo $nr."-" ?>=false">-</a><?= $aantal ?><a href="cart.php?<?php echo $nr ?>">+</a></h4></td>
                <td><h4>€<?= number_format((float)$stockItem['SellPrice'], 2, '.', '') ?></h4></td>
                <td><h4><a href="<?= print("view.php?id=" . $nr) ?>"><?php echo $nr ?></a></h4></td>
                <td><h4><a href="cart.php?<?php echo "del".$nr?>">verwijderen</a> </h4></td>
            </tr>

        <?php
        endforeach;
        ?>

        </tbody>
    </table>
    <h3>Totaalprijs(incl. btw): €<?= number_format((float)$totaalprijs, 2, '.', '') ?></h3>
</div>
</body>
</html>