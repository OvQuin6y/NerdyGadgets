<!--de pagina met alle inhoud van de winkelwagen-->
<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";
$totaalPrijs = 0;
$lang = $_SESSION["lang"];
$databaseConnection = connectToDatabase();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title><?php echo getTranslation($databaseConnection, $lang, "Winkelmandje_paginatitel")?></title>
    <link rel="stylesheet" href="Public/CSS/cart.css">
</head>
<body>
<div class="maincontainer">
    <h1><?php echo getTranslation($databaseConnection, $lang, "Winkelmandje_titel_overzicht")?></h1>
    <table id="checkoutItems">
        <thead>
        <tr class="titles">
            <td><?php echo getTranslation($databaseConnection, $lang, "Winkelmandje_overzicht_afbeelding") . ":"?></td>
            <td><?php echo getTranslation($databaseConnection, $lang, "Winkelmandje_en_checkout_overzicht_naam") . ":"?></td>
            <td><?php echo getTranslation($databaseConnection, $lang, "Winkelmandje_en_checkout_overzicht_aantal") . ":"?></td>
            <td><?php echo getTranslation($databaseConnection, $lang, "Winkelmandje_overzicht_prijs") . ":"?></td>
            <td><?php echo getTranslation($databaseConnection, $lang, "Winkelmandje_overzicht_ID") . ":"?></td>
            <td></td>
        </tr>
        </thead>
        <tbody class="bodycontainer">
        <?php
        $cart = getCart();
        foreach ($cart as $nr => $aantal):
            $stockItem = getStockItem($nr, $databaseConnection, $_SESSION["lang"]);
            $stockItemImage = getStockItemImage($nr, $databaseConnection);
            $totaalPrijs += $aantal * $stockItem['SellPrice'];
            if (isset($_GET["del" . $nr])) {
                deleteProductFromCart($nr);
                unset($_GET["del" . $nr]);
                echo "<meta http-equiv='refresh' content='0'>";
            }
            if (isset($_POST["quantity" . $nr])) {
                setProductInCart($nr, $_POST["quantity" . $nr]);
                echo "<meta http-equiv='refresh' content='0'>";
            }
            ?>
            <tr class="data">
                <td>
                    <img src="<?php if (!empty($stockItemImage) ? print($stockItemImage[0]['ImagePath']) : print 'error.png') ?>">
                </td>
                <td><h6><?= $stockItem['StockItemName'] ?></h6></td>
                <td>
                    <div class="qty-container">
                         <h4>
                            <form class="aantalform" action="cart.php" method="post"><input class="aantal" type="number"
                                                                                            name="<?php echo "quantity" . $nr ?>"
                                                                                            min="1"
                                                                                            max="<?php $stockItem["QuantityOnHand"] ?>"
                                                                                            value="<?php echo (isset($_POST["quantity" . $nr])) ? $_POST["quantity" . $nr] : $aantal ?>"
                                                                                            placeholder="<?php echo (isset($_POST["quantity" . $nr])) ? $_POST["quantity" . $nr] : $aantal ?>"><input
                                        class="aantal2" type="submit" value="OK"></form>
                        </h4>
                    </div>
                </td>
                <td><h4>€<?= number_format((float)$stockItem['SellPrice'], 2, '.', '') ?></h4></td>
                <td><h4><a href="view.php?id=<?= $nr ?>"><?php echo $nr ?></a></h4></td>
                <td><h4><a href="cart.php?<?php echo "del" . $nr ?>"><?php echo getTranslation($databaseConnection, $lang, "Winkelmandje_laatste_kolom")?></a></h4></td>
            </tr>

        <?php
        endforeach;
        ?>

        </tbody>
    </table>
    <h3><?php echo getTranslation($databaseConnection, $lang, "Winkelmandje_en_checkout_totaalprijs") . ": €"?><?= number_format((float)$totaalPrijs, 2, '.', '') ?></h3>
    <form method="post" action="orderlogin.php" id="orderForm"><br>
        <input type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "Winkelmandje_overzicht_button")?>" name="knop" class="Button_place_order">
        <br>
    </form>
    <script>
        var form = document.getElementById("orderForm");
        var checkoutItemsLength = document.getElementById("checkoutItems").rows.length;

        form.addEventListener("submit", function (event) {
            if (checkoutItemsLength <= 1) {
                event.preventDefault();
                alert(<?php echo getTranslation($databaseConnection, $lang, "Winkelmandje_leeg_winkelmandje")?>);
            }
        });
    </script>
</div>
</body>
</html>