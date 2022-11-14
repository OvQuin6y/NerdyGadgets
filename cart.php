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
    <div class="headcontainer">
        <h4>Image:</h4>
        <h4>Name:</h4>
        <h4>Quantity:</h4>
        <h4>Price:</h4>
    </div>
    <?php
    $cart = getCart();
    foreach ($cart as $nr => $aantal):
        $StockItem = getStockItem($nr, $databaseConnection);
        $stockItemImage = getStockItemImageVoorWWagen($nr, $databaseConnection);
        $totaalprijs += $aantal * 2.5; ?>
        <div class="bodycontainer">
            <?php foreach ($stockItemImage as $foto)
                if (isset($foto)) {
                    array_values($foto)[0];
                    ?>
                    <img src="Public/StockItemIMG/<?php print($foto['ImagePath']) ?>">
                    <?php
                } else {
                    $foto = null;
                } ?>
            <h4><a href="<?= print("view.php?id=" . $nr) ?>"><?php echo $nr ?></a></h4>
            <h4><?= $cart[$nr] ?></h4>
            <h4>€2,50</h4>
        </div>
    <?php endforeach; ?>
    <h3>Totaalprijs: €<?= number_format((float)$totaalprijs, 2, '.', '')?></h3>
</div>
<!--<table>-->
<!--    <thead>-->
<!--    <tr>-->
<!--        <td>Image</td>-->
<!--        <td>Name</td>-->
<!--        <td>Quantity</td>-->
<!--        <td>Price</td>-->
<!--    </tr>-->
<!--    </thead>-->
<!--    <tbody>-->
<!--    --><?php
//
//    foreach ($cart as $nr => $aantal) : ?>
<!--        --><?php
//        $StockItem = getStockItem($nr, $databaseConnection);
//        $stockItemImage = getStockItemImageVoorWWagen($nr, $databaseConnection);
//        $totaalprijs += $aantal * 2.5;
//        ?>
<!--        <tr>-->
<!--            <td>-->
<!--                --><?php
//                foreach ($stockItemImage as $foto)
//                    if (isset($foto)) {
//                        array_values($foto)[0];
//                        ?>
<!--                        <img style="height=50px width=50px"-->
<!--                             src="Public/StockItemIMG/--><?php //print($foto['ImagePath']) ?><!--">-->
<!--                        --><?php
//                    } else {
//                        $foto = null;
//                    } ?>
<!--            </td>-->
<!--            <td><a href="--><?php //print("view.php?id=" . $nr) ?><!--">--><?php //echo $nr ?><!--</a></td>-->
<!--            <td>--><?php //echo $cart[$nr] ?><!--</td>-->
<!--            <td>--><?php //echo "€2,50" ?><!--</td>-->
<!--        </tr>-->
<!--    --><?php //endforeach; ?>
<!--    </tbody>-->
<!--</table>-->
<!---->
<?php
//print("<br><br>Totaalprijs: €" . number_format((float)$totaalprijs, 2, '.', ''))


//gegevens per artikelen in $cart (naam, prijs, etc.) uit database halen
//totaal prijs berekenen
//mooi weergeven in html
//etc.

?>

</body>
</html>