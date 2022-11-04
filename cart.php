<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

$databaseConnection = connectToDatabase();
$cart = getCart();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Public/CSS/cart.css">
    <title>Winkelwagen</title>
</head>
<body>
<?php

//gegevens per artikelen in $cart (naam, prijs, etc.) uit database halen
//totaal prijs berekenen
//mooi weergeven in html
//etc.
?>
<div class="maincontainer">
    <h1>Inhoud Winkelwagen</h1>
    <div class="productcontainer">
        <?php
        foreach ($cart as $product):
            ?>
            <div class="rowcontainer">
                <h4><?= print $product ?></h4>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>
<p><a href='view.php?id=0'>Naar artikelpagina van artikel 0</a></p>
</body>
</html>
