<!--de pagina met alle inhoud van de winkelwagen-->
<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";
$totaalPrijs = 0;
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Shopping cart</title>
    <link rel="stylesheet" href="Public/CSS/cart.css">
</head>
<body>
<div class="maincontainer">
    <h1>Shopping cart contents</h1>
    <table id="checkoutItems">
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
                    <img src="Public/StockItemIMG/<?php if (!empty($stockItemImage) ? print($stockItemImage[0]['ImagePath']) : print 'error.png') ?>">
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
                <td><h4><a href="cart.php?<?php echo "del" . $nr ?>">Delete</a></h4></td>
            </tr>

        <?php
        endforeach;
        ?>

        </tbody>
    </table>
    <h3>Total price (incl. BTW): €<?= number_format((float)$totaalPrijs, 2, '.', '') ?></h3>
    <form method="post" action="orderlogin.php" id="orderForm">
        <br>
        <input type="submit" value="Place order" name="knop" class="Button_place_order">
        <br>
    </form>
    <script>
        var form = document.getElementById("orderForm");
        var checkoutItemsLength = document.getElementById("checkoutItems").rows.length;

        form.addEventListener("submit", function (event) {
            if (checkoutItemsLength <= 1) {
                event.preventDefault();
                alert("You can't place an order with an empty cart!");
            }
        });
    </script>
</div>
</body>
</html>