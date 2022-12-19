<!-- dit bestand bevat alle code voor de pagina die één product laat zien -->
<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

$lang = $_SESSION["lang"];
$databaseConnection = connectToDatabase();

$StockItem = getStockItem($_GET['id'], $databaseConnection,$_SESSION["lang"]);
$StockItemImage = getStockItemImage($_GET['id'], $databaseConnection);
?>
<link rel="stylesheet" href="Public/CSS/cart.css">
<div id="CenteredContent">
    <?php
    if ($StockItem != null) {
        if (isset($StockItem['Video'])) {
            ?>
            <div id="VideoFrame">
                <?php print $StockItem['Video']; ?>
            </div>
        <?php }
        ?>


        <div id="ArticleHeader">
            <?php
            if (isset($StockItemImage)) {
                // één plaatje laten zien
                if (count($StockItemImage) == 1) {
                    ?>
                    <div id="ImageFrame"
                         style="background-image: url('Public/StockItemIMG/<?php print $StockItemImage[0]['ImagePath']; ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;"></div>
                    <?php
                } else if (count($StockItemImage) >= 2) { ?>
                    <!-- meerdere plaatjes laten zien -->
                    <div id="ImageFrame">
                        <div id="ImageCarousel" class="carousel slide" data-interval="false">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                <?php for ($i = 0; $i < count($StockItemImage); $i++) {
                                    ?>
                                    <li data-target="#ImageCarousel"
                                        data-slide-to="<?php print $i ?>" <?php print (($i == 0) ? 'class="active"' : ''); ?>></li>
                                    <?php
                                } ?>
                            </ul>

                            <!-- slideshow -->
                            <div class="carousel-inner">
                                <?php for ($i = 0; $i < count($StockItemImage); $i++) {
                                    ?>
                                    <div class="carousel-item <?php print ($i == 0) ? 'active' : ''; ?>">
                                        <img src="Public/StockItemIMG/<?php print $StockItemImage[$i]['ImagePath'] ?>">
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- knoppen 'vorige' en 'volgende' -->
                            <a class="carousel-control-prev" href="#ImageCarousel" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#ImageCarousel" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div id="ImageFrame"
                     style="background-image: url('Public/StockGroupIMG/<?php print $StockItem['BackupImagePath']; ?>'); background-size: cover;"></div>
                <?php
            }
            ?>

            <h1 class="StockItemID"><?php echo getTranslation($databaseConnection, $lang, "Artikelnummer") . ": " .  $StockItem["StockItemID"]; ?></h1>
            <h2 class="StockItemNameViewSize StockItemName">
                <?php print $StockItem['StockItemName']; ?>
            </h2>

            <div class="QuantityText"><?php if ($StockItem["QuantityOnHand"] > 1000) {
                    print(getTranslation($databaseConnection, $lang, "Voorraad_veel_aanwezig"));
                } elseif ($StockItem["QuantityOnHand"] <= 0) {
                    print(getTranslation($databaseConnection, $lang, "Voorraad_afwezig"));
                } elseif ($StockItem["QuantityOnHand"] == 1) {
                    print(getTranslation($databaseConnection, $lang, "Voorraad_een_deel1") . " ". $StockItem['QuantityOnHand'] . " " .  getTranslation($databaseConnection, $lang, "Voorraad_een_deel2"));
                } elseif ($StockItem["QuantityOnHand"] <= 50) {
                    print(getTranslation($databaseConnection, $lang, "Voorraad_minder_dan_vijftig_deel1") . " " . $StockItem['QuantityOnHand'] . " " . getTranslation($databaseConnection, $lang, "Voorraad_minder_dan_vijftig_deel2"));
                } else {
                    print($StockItem["QuantityOnHand"] . " " . getTranslation($databaseConnection, $lang, "Voorraad_overige_opties"));
                }; ?></div>

            <div id="StockItemHeaderLeft">
                <div class="CenterPriceLeft"><br>
                    <div class="CenterPriceLeftChild">
                        <p class="StockItemPriceText"><b><?php print sprintf("€ %.2f", $StockItem['SellPrice']); ?>
                        </p>
                        <h6><?php echo getTranslation($databaseConnection, $lang, "Prijs_regel")?></h6>
                        <?php
                        //?id=1 handmatig meegeven via de URL (gebeurt normaal gesproken als je via overzicht op artikelpagina terechtkomt)
                        if (isset($_GET["id"])) {
                            $stockItemID = $_GET["id"];
                        } else {
                            $stockItemID = 0;
                        }
                        ?>
                        <form method="post">
                            <input type="number" name="stockItemID" value="<?php print($stockItemID) ?>" hidden>
                            <?php
                            if ($StockItem['QuantityOnHand'] > 0) {
                                ?>
                                <input type="submit" name="submit" value="<?php echo getTranslation($databaseConnection, $lang, "Toevoegen_winkelmandje_button")?>" class="Button_add_to_cart">
                                <?php
                            }
                            ?>
                        </form>
                        <?php

                        if (isset($_POST["submit"])) {              // zelfafhandelend formulier
                            $stockItemID = $_POST["stockItemID"];
                            addProductToCart($stockItemID);         // maak gebruik van geïmporteerde functie uit cartfuncties.php
                            print(getTranslation($databaseConnection, $lang, "Toevoegen_winkelmandje1") . " " . "<a href='cart.php'>" . " " . getTranslation($databaseConnection, $lang, "Toevoegen_winkelmandje2") . "!" ."</a>");
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="StockItemDescription">
            <h3><?php echo getTranslation($databaseConnection, $lang, "Productinformatie_titel_omschrijving")?></h3>
            <p><?php print $StockItem['SearchDetails']; ?></p>
        </div>
        <div id="StockItemSpecifications">
            <h3><?php echo getTranslation($databaseConnection, $lang, "Productinformatie_titel_specificaties")?></h3>
            <?php
            $CustomFields = json_decode($StockItem['CustomFields'], true);
            if (is_array($CustomFields)) { ?>
                <table>
                <thead>
                <th><?php echo getTranslation($databaseConnection, $lang, "Productinformatie_specificaties_naam")?></th>
                <th><?php echo getTranslation($databaseConnection, $lang, "Productinformatie_specificaties_data")?></th>
                </thead>
                <?php
                foreach ($CustomFields as $SpecName => $SpecText) { ?>
                    <tr>
                        <td>
                            <?php print $SpecName; ?>
                        </td>
                        <td>
                            <?php
                            if (is_array($SpecText)) {
                                foreach ($SpecText as $SubText) {
                                    print $SubText . " ";
                                }
                            } else {
                                print $SpecText;
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                </table><?php
            } else { ?>

                <p><?php print $StockItem['CustomFields']; ?>.</p>
                <?php
            }
            ?>
        </div>
        <?php
    } else {
        ?><h2 id="ProductNotFound">The searched product could not be found</h2><?php
    } ?>
</div>