<!-- de inhoud van dit bestand wordt bovenaan elke pagina geplaatst -->
<?php
if (!isset($_SESSION)) {
    session_start();
}
$_SESSION["lang"] = "en";
include "database.php";
$databaseConnection = connectToDatabase();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>NerdyGadgets</title>

    <!-- Javascript -->
    <script src="Public/JS/fontawesome.js"></script>
    <script src="Public/JS/jquery.min.js"></script>
    <script src="Public/JS/bootstrap.min.js"></script>
    <script src="Public/JS/popper.min.js"></script>
    <script src="Public/JS/resizer.js"></script>

    <!-- Style sheets-->
    <link rel="stylesheet" href="Public/CSS/style.css" type="text/css">
    <link rel="stylesheet" href="Public/CSS/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="Public/CSS/typekit.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
<div class="Background">
    <div class="row" id="Header">
        <div class="col-2"><a href="./" id="LogoA">
                <div id="LogoImage"><img src="Public/Img/NerdyGadgetsLogo.png"></div>
            </a></div>
        <div class="col-8" id="CategoriesBar">
            <ul id="ul-class">
                <?php
                $HeaderStockGroups = getHeaderStockGroups($databaseConnection, $_SESSION["lang"]);

                foreach ($HeaderStockGroups as $HeaderStockGroup) {
                    ?>
                    <li>
                        <a href="browse.php?category_id=<?php print $HeaderStockGroup['StockGroupID']; ?>"
                           class="HrefDecoration"><?php print $HeaderStockGroup['StockGroupName']; ?></a>
                    </li>
                    <?php
                }
                ?>
                <li>
                    <a href="categories.php" class="HrefDecoration">All categories</a>

                </li>
            </ul>
        </div>
        <!-- code voor US3: zoeken -->
        <ul id="ul-class-navigation">
            <li class="header-right">
                <form method="post" action="database.php" class="language">
                    <SELECT id= "selectLang" name="language" onchange="changeLanguage()">
                        <OPTION value=""></OPTION>
                        <OPTION value="en">English</OPTION>
                        <OPTION value="nl">Nederlands</OPTION>
                    </SELECT>
                </form>
                <a href="browse.php" class="HrefDecoration"><i class="fas fa-search search"></i> Search</a>
                <a href="cart.php" class="HrefDecoration"><img class="Cart-Image" src="Public/Img/winkelwagen.png"></a>
            </li>
        </ul>
        <!-- einde code voor US3 zoeken -->
    </div>
    <script>
        function changeLanguage() {
            let lang = document.getElementById("selectLang");
            let value = lang.value;
            window.location.replace("change_language.php?lang=" + value)
        }
    </script>
    <div class="row" id="Content">
        <div class="col-12">
            <div id="SubContent">