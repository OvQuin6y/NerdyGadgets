<!-- dit bestand bevat alle code voor de pagina die één product laat zien -->
<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

$lang = $_SESSION["lang"];
$databaseConnection = connectToDatabase();

if (!$databaseConnection) {
    die('Failed to make connection');
}
if (isset($_POST['submitModal'], $_POST['rating'], $_POST['w3review'])) {

    $addReview = $databaseConnection->prepare("INSERT INTO reviews(klantID, StockItemID, rating, memo) 
    VALUES (?,?,?,?)");
    $addReview->bind_param("iiis", $_SESSION["klantID"], $_GET['id'], $_POST['rating'], $_POST['w3review']);
    $addReview->execute();
    ?>
    <script type="text/javascript">
        let url="view.php?id="
       let product = "<?php echo $_GET['id'] ?>"
       location.href= url + product
           </script>
<?php
} ?>

<!-- ('Location: http://www.nerdygagdgets.view.php/');-->
<?php
$StockItem = getStockItem($_GET['id'], $databaseConnection, $_SESSION["lang"]);
$StockItemImage = getStockItemImage($_GET['id'], $databaseConnection);
$reviews = getReviews($databaseConnection, $_GET['id']);


?>
<link href="browse.php">
<style xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">

</style>
<link rel="stylesheet" href="Public/CSS/cart.css">
<link rel="stylesheet" href="Public/CSS/review.css">
<div id="CenteredContent">
    <?php
    if ($StockItem != null){
    if (isset($StockItem['Video'])) {
        ?>
        <div id="VideoFrame">
            <?php print $StockItem['Video']; ?>
        </div>
    <?php }
    ?>
    <script type="text/javascript">
        function openModal() {
            <?php
            if(!isset($_SESSION["klantID"])) {
            ?>
            window.location.href = "Login.php";
            <?php
            }
            ?>
        }
    </script>


    <!-- Trigger the modal with a button -->
    <button type="button" class="Button_add_to_cart" data-toggle="modal" data-target="#myModal" onclick="openModal()">
        Review this product
    </button>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Review</h4>
                </div>
                <form method="post" action="view.php?id=<?php echo $_GET['id']; ?>">
                    <div class="modal-body">
                        <div class="container d-flex justify-content-center">
                            <div class="card text-center">



                                <textarea id="test" name="w3review" placeholder="Typ your review" rows="4" cols="50"
                                          maxlength="150" required></textarea>
                                <br>


                                <div class="rate bg-success py-3 text-white mt-3">
                                    <h6 class="mb-0">Rate this product</h6>
                                    <div class="rating">
                                        <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                                        <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                                        <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                        <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                        <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input name="submitModal" type="submit" class="upload" value="Upload">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>

        </div>
    </div>

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

        <h1 class="StockItemID"><?php echo getTranslation($databaseConnection, $lang, "Artikelnummer") . ": " . $StockItem["StockItemID"]; ?></h1>
        <h2 class="StockItemNameViewSize StockItemName">
            <?php print $StockItem['StockItemName']; ?>
        </h2>

        <div class="QuantityText"><?php if ($StockItem["QuantityOnHand"] > 1000) {
                print(getTranslation($databaseConnection, $lang, "Voorraad_veel_aanwezig"));
            } elseif ($StockItem["QuantityOnHand"] <= 0) {
                print(getTranslation($databaseConnection, $lang, "Voorraad_afwezig"));
            } elseif ($StockItem["QuantityOnHand"] == 1) {
                print(getTranslation($databaseConnection, $lang, "Voorraad_een_deel1") . " " . $StockItem['QuantityOnHand'] . " " . getTranslation($databaseConnection, $lang, "Voorraad_een_deel2"));
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
                    <h6><?php echo getTranslation($databaseConnection, $lang, "Prijs_regel") ?></h6>
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
                            <input type="submit" name="submit"
                                   value="<?php echo getTranslation($databaseConnection, $lang, "Toevoegen_winkelmandje_button") ?>"
                                   class="Button_add_to_cart">
                            <?php
                        }
                        ?>
                    </form>
                    <?php

                    if (isset($_POST["submit"])) {              // zelfafhandelend formulier
                        $stockItemID = $_POST["stockItemID"];
                        addProductToCart($stockItemID);         // maak gebruik van geïmporteerde functie uit cartfuncties.php
                        print(getTranslation($databaseConnection, $lang, "Toevoegen_winkelmandje1") . " " . "<a href='cart.php'>" . " " . getTranslation($databaseConnection, $lang, "Toevoegen_winkelmandje2") . "!" . "</a>");
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>

    <div id="StockItemDescription">
        <h3><?php echo getTranslation($databaseConnection, $lang, "Productinformatie_titel_omschrijving") ?></h3>
        <p><?php print $StockItem['SearchDetails']; ?></p>
    </div>

    <div id="StockItemSpecifications">
        <h3><?php echo getTranslation($databaseConnection, $lang, "Productinformatie_titel_specificaties") ?></h3>
        <?php
        $CustomFields = json_decode($StockItem['CustomFields'], true);
        if (is_array($CustomFields)) { ?>
            <table>
            <thead>
            <th><?php echo getTranslation($databaseConnection, $lang, "Productinformatie_specificaties_naam") ?></th>
            <th><?php echo getTranslation($databaseConnection, $lang, "Productinformatie_specificaties_data") ?></th>
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
    <div class="reviewMainContainer">
        <h3>Recent reviews</h3>
        <?php foreach ($reviews as $review):?>
        <div class="review">
            <h5><?=$review['memo']?></h5
            <h5><?=$review['rating']?></h5
        </div>
    </div>
<?php endforeach; ?>

<?php
} else {
    ?><h2 id="ProductNotFound">The searched product could not be found</h2><?php
} ?>
</div>