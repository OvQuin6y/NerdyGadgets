<?php
include "database.php";

$databaseConnection = connectToDatabase();

error_reporting(E_ERROR | E_PARSE);

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
    <title>Order Cancellation</title>
</head>
<body>
<style>
    .container {
        width: 500px;
        margin: auto;
        border: 1px solid black;
        padding: 10px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
<div class="container">
<form action="cancel_order.php" method="post">
    <h1>Cancellation code: <?php echo $_SESSION["cancelCode"];?></h1>
    <label for="code">Verificatie Code:</label>
    <input type="number" name="code" id="code" pattern="[0-9]{6}" required> <br>
    <input type="submit" value="Verstuur" name="submit">
</form>
</div>
</body>
</html>
<?php
    if(isset($_POST["submit"])) {
        try {
            $cancelCode = $_SESSION["cancelCode"];
            $query = "SELECT VerificationCode AS vc FROM orders WHERE CancelCode = '" . $cancelCode . "'";
            $statement = mysqli_prepare($databaseConnection, $query);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            $row = mysqli_fetch_assoc($result);
            $verCode = $row["vc"];
            if($verCode == $_POST["code"]) {
                $query = "DELETE FROM orders WHERE CancelCode = '" . $cancelCode . "'";
                $statement = mysqli_prepare($databaseConnection, $query);
                mysqli_stmt_execute($statement);
                ?>
                <script type="text/javascript">
                    alert("Your order has been cancelled.");
                </script>
                <?php
            } else {
                ?>
                <script type="text/javascript">
                    alert("Your order could not be cancelled.");
                </script>
                <?php
            }
        } catch (Exception $e) {
            ?>
            <script type="text/javascript">
                alert("Something unexpected happend.");
            </script>
            <?php
        }
    }
?>