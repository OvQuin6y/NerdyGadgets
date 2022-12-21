<!-- dit bestand bevat alle code die verbinding maakt met de database -->
<?php

function connectToDatabase() {
    $Connection = null;

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Set MySQLi to throw exceptions
    try {
        $Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
        mysqli_set_charset($Connection, 'latin1');
        $DatabaseAvailable = true;
    } catch (mysqli_sql_exception $e) {
        $DatabaseAvailable = false;
    }
    if (!$DatabaseAvailable) {
        ?><h2>The website is currently under construction.</h2><?php
        die();
    }

    return $Connection;
}

function getHeaderStockGroups($databaseConnection, $language) {
    $table = "stockgroups_" . $language;
    $Query = "
                SELECT StockGroupID, StockGroupName, ImagePath
                FROM " . $table .  "
                WHERE StockGroupID IN (
                                        SELECT StockGroupID 
                                        FROM stockitemstockgroups
                                        ) AND ImagePath IS NOT NULL
                ORDER BY StockGroupID ASC";
    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);
    $HeaderStockGroups = mysqli_stmt_get_result($Statement);
    return $HeaderStockGroups;
}

function getStockGroups($databaseConnection, $language) {
    $table = "stockgroups_" . $language;
    $group = "";
    $getStockGroups = $databaseConnection->prepare("
            SELECT StockGroupID, StockGroupName, ImagePath
            FROM ?
            WHERE StockGroupID IN (
                                    SELECT StockGroupID 
                                    FROM stockitemstockgroups
                                    ) AND ImagePath IS NOT NULL
            ORDER BY StockGroupID ASC");
    $getStockGroups->bind_param("s", $table);
    $getStockGroups->execute();
    $getStockGroups->store_result();
    $getStockGroups->bind_result($group);
    return $group;
}

function getStockItem($id, $databaseConnection, $language) {
    $Result = null;
    $table = "stockgroups_" .  $language;
    $Query = " 
           SELECT SI.StockItemID, 
            (RecommendedRetailPrice*(1+(TaxRate/100))) AS SellPrice, 
            StockItemName,
            QuantityOnHand,
            SearchDetails, 
            (CASE WHEN (RecommendedRetailPrice*(1+(TaxRate/100))) > 50 THEN 0 ELSE 6.95 END) AS SendCosts, MarketingComments, CustomFields, SI.Video,
            (SELECT ImagePath FROM " . $table .  " JOIN stockitemstockgroups USING(StockGroupID) WHERE StockItemID = SI.StockItemID LIMIT 1) as BackupImagePath   
            FROM stockitems SI 
            JOIN stockitemholdings SIH USING(stockitemid)
            JOIN stockitemstockgroups ON SI.StockItemID = stockitemstockgroups.StockItemID
            JOIN " . $table .  " USING(StockGroupID)
            WHERE SI.stockitemid = ?
            GROUP BY StockItemID";

    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_bind_param($Statement, "i", $id);
    mysqli_stmt_execute($Statement);
    $ReturnableResult = mysqli_stmt_get_result($Statement);
    if ($ReturnableResult && mysqli_num_rows($ReturnableResult) == 1) {
        $Result = mysqli_fetch_all($ReturnableResult, MYSQLI_ASSOC)[0];
    }

    return $Result;
}

function getStockItemImage($id, $databaseConnection) {

    $Query = "
                SELECT ImagePath
                FROM stockitemimages 
                WHERE StockItemID = ?";

    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_bind_param($Statement, "i", $id);
    mysqli_stmt_execute($Statement);
    $R = mysqli_stmt_get_result($Statement);
    $R = mysqli_fetch_all($R, MYSQLI_ASSOC);

    return $R;
}

function getStock($id, $databaseConnection) {

    $Query = "
                SELECT QuantityOnHand
                FROM stockitemholdings
                WHERE StockItemID = ?   ";

    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_bind_param($Statement, "i", $id);
    mysqli_stmt_execute($Statement);
    $R = mysqli_stmt_get_result($Statement);
    $R = mysqli_fetch_all($R, MYSQLI_ASSOC);

    return $R;
}

function getPassword(mysqli $databaseConnection, $mail)
{
    $query = "
                SELECT Password
                FROM klant
                WHERE Email ='" . $mail .  "';";

    $result = $databaseConnection->query($query);
    $return = "";
    while ($row = $result->fetch_array()) {
        $return = $row["Password"];
    }
    return $return;
}

function getID(mysqli $databaseConnection, $mail)
{
    $query = "
                SELECT klantID
                FROM klant
                WHERE Email ='" . $mail .  "';";

    $result = $databaseConnection->query($query);
    $return = "";
    while ($row = $result->fetch_array()) {
        $return = $row["klantID"];
    }
    return $return;
}

function getName(mysqli $databaseConnection, $id)
{
    $query = "
                SELECT FirstName
                FROM klant
                WHERE klantID = $id";

    $result = $databaseConnection->query($query);
    $return = "";
    while ($row = $result->fetch_array()) {
        $return = $row["FirstName"];
    }
    return $return;
}
function getKlant(mysqli $databaseConnection, $id)
{
    $query = "
                SELECT *
                FROM klant
                WHERE klantID ='" . $id .  "';";

    $Statement = mysqli_prepare($databaseConnection, $query);
    mysqli_stmt_execute($Statement);
    $R = mysqli_stmt_get_result($Statement);
    $R = mysqli_fetch_all($R, MYSQLI_ASSOC);

    return $R;
}
function updateKlant(mysqli $databaseConnection, $id, $firstName, $lastName, $email, $phoneNumber, $postalCode, $houseNumber, $city)
{
    $query = "
                UPDATE klant
                SET FirstName = '$firstName', LastName = '$lastName', Email = '$email', PhoneNumber = '$phoneNumber',
                    PostalCode = '$postalCode', HouseNumber = '$houseNumber', City = '$city'
                WHERE klantID = $id";

    $Statement = mysqli_prepare($databaseConnection, $query);
    mysqli_stmt_execute($Statement);
}