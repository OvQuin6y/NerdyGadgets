<?php
include "cartfuncties.php";
include "database.php";
include "utils.php";
include "languageFunctions.php";

$databaseConnection = connectToDatabase();
$lang = $_SESSION["lang"];

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION["transactionOngoing"]) || !$_SESSION["transactionOngoing"]) {
    header("Location: browse.php");
}

?>
    <!DOCTYPE html>
    <html lang="nl">
    <head>
        <meta charset="utf-8">
        <title><?php echo getTranslation($databaseConnection, $lang, "Betaalbevestigingsscherm_paginatitel") ?></title>
    </head>
    <body style="background-color:#FFFFFF;">
    <style>
        h1 {
            text-align: center;
        }

        h2 {
            text-align: center;
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 10%;
        }

        form {
            text-align: center;
        }

        .form-submit-button {
            background: #676EFF;
            text-align: center;
            color: white;
            border-style: outset;
            border-color: #676EFF;
            border-radius: 12px;
            height: 45px;
            width: 350px;
        }
    </style>
    <br>
    <h1 style="font-size:300px;"></h1>
    <h2 style="font-size:20px;"><?php echo getTranslation($databaseConnection, $lang, "Betaalbevestigingsscherm_tekst") . "." ?></h2>
    <form method="post" action="browse.php">
        <br>
        <input style="font-size:20px;" type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "Betaalbevestigingsscherm_knop_terug_naar_site") ?>"
               href="http://localhost/NerdyGadgets/ideal.php"
               class="form-submit-button">
    </form>
    </body>
    </html>
<?php
if ($_POST && isset($_SESSION["transactionOngoing"]) && $_SESSION["transactionOngoing"]) {
    $getCart = getCart();
    $fname = $_SESSION["fname"];
    $lname = $_SESSION["lname"];
    $pcode = $_SESSION["pcode"];
    $hnumber = $_SESSION["hnumber"];
    $dpcode = $_SESSION["dpcode"];
    $daline1 = $_SESSION["daline1"];
    $daline2 = $_SESSION["daline2"];
    $paline1 = $_SESSION["paline1"];
    $paline2 = $_SESSION["paline2"];
    $pnumber = $_SESSION["pnumber"];
    $email = $_SESSION["e-mail"];
    $fullname = $fname . " " . $lname;

    $newStock = 0;
    $customerID = 0;
    $date = date("Y/m/d");
    $orderID = 0;
    // generate a short hash and add the order id to it
    $hash = substr(md5(rand()), 0, 7).$orderID;
    // generate a 6 digit code
    $cancelCode = '';
    for ($i = 0; $i < 6; $i++) {
        $cancelCode .= mt_rand(0, 9);
    }
    $cancelCode = intval($cancelCode);
    try {
        $databaseConnection->autocommit(FALSE);
        $databaseConnection->begin_transaction();
        $addCustomer = $databaseConnection->prepare("INSERT INTO customers(CustomerName, BillToCustomerID, CustomerCategoryID,AccountOpenedDate,                      
        PhoneNumber, DeliveryAddressLine1, DeliveryAddressLine2,                      
        DeliveryPostalCode, PostalAddressLine1,PostalAddressLine2,PostalPostalCode,                      
        ValidFrom, ValidTo)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $dateToValid = "9999-12-31 23:59:59";
        $billToCustomerId = 1;
        $customerCategoryId = 3;
        $addCustomer->bind_param("siissssssssss", $fullname, $billToCustomerId, $customerCategoryId, $date, $pnumber, $daline1, $daline2, $dpcode, $paline1, $paline2, $pcode, $date, $dateToValid);
        $addCustomer->execute();
        $getCustomerid = $databaseConnection->prepare("SELECT CustomerID FROM customers WHERE CustomerName = ? AND PhoneNumber = ?");
        $getCustomerid->bind_param("ss", $fullname, $pnumber);
        $getCustomerid->execute();
        $getCustomerid->store_result();
        $getCustomerid->bind_result($result);
        while ($getCustomerid->fetch()) {
            $customerID = $result;
        }
        $addOrder = $databaseConnection->prepare("INSERT INTO orders(CustomerID, OrderDate, ExpectedDeliveryDate, IsUndersupplyBackordered, LastEditedBy,
                   LastEditedWhen, CancelCode, VerificationCode) VALUES (?,?,?,?,?,?,?,?)");
        $isUndersupplyBackordered = 0;
        $addOrder->bind_param("ississsi", $customerID, $date, $date, $isUndersupplyBackordered, $date,
            $date, $hash, $cancelCode);
        $addOrder->execute();
        $getOrderID = $databaseConnection->prepare("SELECT OrderID FROM orders ORDER BY OrderID DESC LIMIT 1; ");
        $getOrderID->execute();
        $getOrderID->store_result();
        $getOrderID->bind_result($result);
        while ($getOrderID->fetch()) {
            $orderID = $result;
        }

        foreach ($getCart as $nr => $aantal) {
            $description = "";
            $getStock = $databaseConnection->prepare("SELECT QuantityOnHand FROM stockitemholdings WHERE StockItemID = ?; ");
            $getStock->bind_param("i", $nr);
            $getStock->execute();
            $getStock->store_result();
            $getStock->bind_result($oldStock);
            while ($getStock->fetch()) {
                $newStock = $oldStock - $aantal;
            }
            $updateStock = $databaseConnection->prepare("UPDATE stockitemholdings SET QuantityOnHand = ? WHERE StockitemID = ?; ");
            $updateStock->bind_param("ii", $newStock, $nr);
            $updateStock->execute();
            $getDescription = $databaseConnection->prepare("SELECT SearchDetails FROM stockitems WHERE StockItemID = ?; ");
            $getDescription->bind_param("i", $nr);
            $getDescription->execute();
            $getDescription->store_result();
            $getDescription->bind_result($result);
            while ($getDescription->fetch()) {
                $description = $result;
            }
            $addOrderline = $databaseConnection->prepare("INSERT INTO orderlines(OrderID, StockItemID, Description, Quantity, LastEditedBy, lastEditedWhen)
            VALUES (?,?,?,?,?,?)");
            $addOrderline->bind_param("iisiis", $orderID, $nr, $description, $aantal, $customerID, $date);
            $addOrderline->execute();

        }
        $databaseConnection->commit();
        $databaseConnection->autocommit(TRUE);
        send_email($email, $fullname, generateEmail($databaseConnection, $fullname, $orderID));
        $_SESSION["transactionOngoing"] = false;
        clearCart();
    } catch (Exception $e) {
        $databaseConnection->rollback();
        echo $e;
    }
}

?>