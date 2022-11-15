<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";
$totaalprijs = 0;

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
            <td>Price:</td>
            <td>ID:</td>
        </tr>
        </thead>
        <tbody class="bodycontainer">
        <?php
        $cart = getCart();
        function qtyUp($cart) {
            $cart[$cart] = $cart[$cart] + 1;
        }
        function qtyDown($cart) {
            $cart[$cart] = $cart[$cart] - 1;
        }
        foreach ($cart as $nr => $aantal):
            $StockItem = getStockItem($nr, $databaseConnection);
            $stockItemImage = getStockItemImage($nr, $databaseConnection);
            $totaalprijs += $cart[$nr] * $StockItem['SellPrice']; ?>
            <tr class="data">
                <td>
                    <img src="Public/StockItemIMG/<?php if (!empty($stockItemImage) ? print($stockItemImage[0]['ImagePath']) : print 'error.png') ?>">
                </td>
                <td><h6><?= $StockItem['StockItemName'] ?></h6></td>
                <td><h4><?= $cart[$nr] ?></h4></td>
                <td><h4>€<?= number_format((float)$StockItem['SellPrice'], 2, '.', '') ?></h4></td>
                <td><h4><a href="<?= print("view.php?id=" . $nr) ?>"><?= $nr ?></a></h4></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <h3>Totaalprijs: €<?= number_format((float)$totaalprijs, 2, '.', '') ?></h3>
</div>
</body>
</html>