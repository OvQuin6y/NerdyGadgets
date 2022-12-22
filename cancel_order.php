<?php
include "database.php";

$databaseConnection = connectToDatabase();

if(!isset($_SESSION)) {
    session_start();
}
if(isset($_GET["cancelCode"])) {
    $_SESSION["cancelCode"] = $_GET["cancelCode"];
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Bestelling Annuleren</title>
</head>
<body>
<h1><?php echo $_SESSION["cancelCode"];?></h1>
<form action="cancel_order.php" method="post">
    <label for="code">Verificatie Code:</label>
    <input type="number" name="code" id="code" pattern="[0-9]{6}" required> <br>
    <input type="submit" value="Verstuur" name="submit">
</form>
</body>
</html>
<?php
    if(isset($_POST["submit"])) {
        $cancelCode = $_SESSION["cancelCode"];
        $query = "SELECT VerificationCode AS vc FROM orders WHERE CancelCode = '" . $cancelCode . "'";
        echo $query;
        $statement = mysqli_prepare($databaseConnection, $query);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $row = mysqli_fetch_assoc($result);
        $verCode = $row["vc"];
        if($verCode == $_POST["code"]) {
            $query = "DELETE FROM orders WHERE CancelCode = '" . $cancelCode . "'";
            $statement = mysqli_prepare($databaseConnection, $query);
            mysqli_stmt_execute($statement);
            echo "Your order has been cancelled";
        }
    }


?>