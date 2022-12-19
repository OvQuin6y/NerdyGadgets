<!-- dit bestand bevat alle code voor de pagina die één product laat zien -->
<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

$StockItem = getStockItem($_GET['id'], $databaseConnection,$_SESSION["lang"]);
$StockItemImage = getStockItemImage($_GET['id'], $databaseConnection);
?>
<style>

</style>
<link rel="stylesheet" href="Public/CSS/cart.css">
<link rel="stylesheet" href="Public/CSS/review.css">
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
  <!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Review this product</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Review</h4>
      </div>
      <div class="modal-body">
          <div class="container d-flex justify-content-center">

              <script>
                  $("button").click(function(){
                      $.get("demo_test.asp", function(data, status){
                          alert("Data: " + data + "\nStatus: " + status);
                      });
                  });
              </script>
              <div class="card text-center">
                  <h2 class="StockItemNameViewSize StockItemName text-black-50">
                      <?php print $StockItem['StockItemName']; ?>
                      <?php if (isset($StockItemImage) && count($StockItemImage) > 0) { ?>
                          <div id="ImageFrame" style="background-image: url('Public/StockItemIMG/<?php print $StockItemImage[0]['ImagePath']; ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;"></div>
                      <?php } ?>
                  </h2>

                  <div class="location mt-4">
                      <span class="d-block"><i class="fa fa-map-marker start"></i>
                      <span><i class="fa fa-map-marker stop mt-2"></i>
                  </div>
                  <div class="rate bg-success py-3 text-white mt-3">
                      <h6 class="mb-0">Rate this product</h6>
                      <div class="rating">
                          <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                      </div>
                  </div>
              </div>
          </div>
        <p></p>
      </div>
      <div class="modal-footer">
          <button type="button" class="upload" data-dismiss="modal">Upload</button>

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
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

            <h1 class="StockItemID">Articlenumber: <?php print $StockItem["StockItemID"]; ?></h1>
            <h2 class="StockItemNameViewSize StockItemName">
                <?php print $StockItem['StockItemName']; ?>
            </h2>

            <div class="QuantityText"><?php if ($StockItem["QuantityOnHand"] > 1000) {
                    print("Much stock available");
                } elseif ($StockItem["QuantityOnHand"] <= 0) {
                    print("Product unavailable");
                } elseif ($StockItem["QuantityOnHand"] == 1) {
                    print("Hurry! Only " . $StockItem['QuantityOnHand'] . " item left");
                } elseif ($StockItem["QuantityOnHand"] <= 50) {
                    print("Hurry! Only " . $StockItem['QuantityOnHand'] . " items left");
                } else {
                    print($StockItem["QuantityOnHand"] . " items in stock");
                }; ?></div>

            <div id="StockItemHeaderLeft">
                <div class="CenterPriceLeft"><br>
                    <div class="CenterPriceLeftChild">
                        <p class="StockItemPriceText"><b><?php print sprintf("€ %.2f", $StockItem['SellPrice']); ?>
                        </p>
                        <h6> Including BTW </h6>
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
                                <input type="submit" name="submit" value="Add to shopping cart" class="Button_add_to_cart">
                                <?php
                            }
                            ?>
                        </form>
                        <?php

                        if (isset($_POST["submit"])) {              // zelfafhandelend formulier
                            $stockItemID = $_POST["stockItemID"];
                            addProductToCart($stockItemID);         // maak gebruik van geïmporteerde functie uit cartfuncties.php
                            print("Product added to <a href='cart.php'> shopping cart!</a>");
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        </div>

        <div id="StockItemDescription">
            <h3>Article description</h3>
            <p><?php print $StockItem['SearchDetails']; ?></p>
        </div>
        <div id="StockItemSpecifications">
            <h3>Article specifications</h3>
            <?php
            $CustomFields = json_decode($StockItem['CustomFields'], true);
            if (is_array($CustomFields)) { ?>
                <table>
                <thead>
                <th>Name</th>
                <th>Data</th>
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