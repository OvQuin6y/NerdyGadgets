<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

$databaseConnection = connectToDatabase();
$lang = $_SESSION["lang"];

if (!isset($_SESSION)) {
    session_start();
}

if (ISSET($_POST["login"]) && getPassword($databaseConnection,$_POST["mail"]) == $_POST["pword"]) {
    $_SESSION["klantID"] = getID($databaseConnection,$_POST["mail"]);
    ?>
    <script type="text/javascript">
        window.location.href = "index.php";
    </script>
    <?php
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>register</title>
    <link rel="stylesheet" href="Public/CSS/style.css">
</head>
<body>
<div class="registerTitle">
    <h1><?php echo getTranslation($databaseConnection, $lang, "inloggen")?></h1>
</div>
<div class="loginContainer">
    <form method="post" action="login.php" class="loginForm">
        <div class="loginInput">
            <input type="email" name="mail" placeholder="<?php echo getTranslation($databaseConnection, $lang, "E-mail")?>" class="loginfields" required>
            <input type="password" name="pword" placeholder="<?php echo getTranslation($databaseConnection, $lang, "wachtwoord")?>" class="loginfields" required>
        </div>
        <div class="Checkout_form">
            <input type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "terugnaarwebsite")?>" formaction="index.php" class="Buttons_checkout" formnovalidate>
            <input type="submit" value="<?php echo getTranslation($databaseConnection, $lang, "inloggen")?>" name="login" class="Buttons_checkout">
        </div>
        <h1 style="font-size:20px; text-align: center"><?php echo getTranslation($databaseConnection, $lang, "geenaccount")?> <a href="register.php"><?php echo getTranslation($databaseConnection, $lang, "hier2")?></a></h1>
        <?php
        if (ISSET($_POST["login"]) && getPassword($databaseConnection,$_POST["mail"]) <> $_POST["pword"]) {
            ?>
        <h1 style="font-size:20px; text-align: center; color: red;">Wrong password or e-mail</h1> <?php
            } ?>
    </form>
</div>
</body>

