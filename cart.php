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
<h1>Inhoud Winkelwagen</h1>

<table>
    <thead>
    <tr>
        <td>Plaatje!!!</td>
        <td>ID</td>
        <td>Aantal</td>
        <td>Kosten</td>
    </tr>
    </thead>
    <tbody>
    <?php
    $cart = getCart();
    foreach($cart as $nr => $aantal) : ?>
    <?php
    $StockItem = getStockItem($nr, $databaseConnection);
    $stockItemImage = getStockItemImageVoorWWagen($nr, $databaseConnection);
    $totaalprijs += $aantal * 2.5;
    ?>
    <tr>
        <td><?php
            foreach ($stockItemImage as $foto)
            if (isset($foto)){
                array_values($foto)[0];
                ?>
            <img style="height=50px width=50px" src="Public/StockItemIMG/<?php print($foto['ImagePath']) ?>">
            <?php
            } else {
                $foto = null;
            } ?>
        </td>
        <td><a href="<?php print("view.php?id=" . $nr) ?>"><?php echo $nr ?></a></td>
        <td><?php echo $cart[$nr] ?></td>
        <td><?php echo "€2,50" ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
print("<br><br>Totaalprijs: €" . number_format((float)$totaalprijs, 2, '.', ''))


//gegevens per artikelen in $cart (naam, prijs, etc.) uit database halen
//totaal prijs berekenen
//mooi weergeven in html
//etc.

?>

</body>
</html>