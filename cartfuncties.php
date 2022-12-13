<?php

include "database.php";

if(!isset($_SESSION)) // altijd hiermee starten als je gebruik wilt maken van sessiegegevens
{
    session_start();
}

/**
 * Haal de cart op.
 * @return array De cart.
 */
function getCart() : array
{
    return $_SESSION['cart'] ?? array();   // resulterend winkelmandje terug naar aanroeper functie
}

/**
 * Sla de cart op in de sessie.
 * @param $cart array De cart.
 * @return void Deze functie heeft geen returnwaarde.
 */
function saveCart(array $cart) : void
{
    $_SESSION["cart"] = $cart;                  // werk de "gedeelde" $_SESSION["cart"] bij met de meegestuurde gegevens
}

/**
 * Voeg een product toe aan de cart.
 * @param $stockItemID int Het ID van het product.
 * @return void Deze functie heeft geen returnwaarde.
 */
function addProductToCart(int $stockItemID) : void
{
    $cart = getCart();                          // eerst de huidige cart ophalen

    if (array_key_exists($stockItemID, $cart)) {  //controleren of $stockItemID(=key!) al in array staat
        $cart[$stockItemID] += 1;                   //zo ja:  aantal met 1 verhogen
    } else {
        $cart[$stockItemID] = 1;                    //zo nee: key toevoegen en aantal op 1 zetten.
    }

    saveCart($cart);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
}

/**
 * Verwijder een product uit de cart.
 * @param $stockItemID int Het ID van het product.
 * @return void Deze functie heeft geen returnwaarde.
 */
function removeProductFromCart(int $stockItemID) : void
{
    $cart = getCart();                          // eerst de huidige cart ophalen

    if (array_key_exists($stockItemID, $cart)) {  //controleren of $stockItemID(=key!) al in array staat
        $cart[$stockItemID] -= 1;                   //zo ja:  aantal met 1 verlagen
    } else {
        $cart[$stockItemID] = 1;                    //zo nee: key toevoegen en aantal op 1 zetten.
    }

    saveCart($cart);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
}

/**
 * Verwijder een product uit de cart.
 * @param $stockItemID int Het ID van het product.
 * @return void Deze functie heeft geen returnwaarde.
 */
function deleteProductFromCart(int $stockItemID) : void
{
    $cart = getCart();                          // eerst de huidige cart ophalen

    if (array_key_exists($stockItemID, $cart)) {  //controleren of $stockItemID(=key!) al in array staat
        unset($cart[$stockItemID]);                   //zo ja:  aantal met 1 verlagen
    }

    saveCart($cart);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
}

/**
 * Verander het aantal van een product in de cart.
 * @param $stockItemID int Het ID van het product.
 * @param $amount int Het nieuwe aantal.
 * @return void Deze functie heeft geen returnwaarde.
 */
function setProductInCart(int $stockItemID, int $amount) : void
{
    $cart = getCart();                          // eerst de huidige cart ophalen
    $cart[$stockItemID] = $amount;

    saveCart($cart);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
}

/**
 * Leeg de cart.
 * @return void Deze functie heeft geen returnwaarde.
 */
function clearCart() : void
{
    $cart = getCart();  // haal de huidige cart op

    foreach ($cart as $nr => $aantal) { // loop door de cart
        deleteProductFromCart($nr);  // verwijder elk product uit de cart
    }
}

/**
 * Kijkt of de cart leeg is.
 * @return bool True als de cart leeg is, anders false.
 */
function isCardEmpty(): bool
{
    $cart = getCart();  // haal de huidige cart op

    if (count($cart) == 0) {  // kijk of de cart leeg is
        return true; // als de cart leeg is, geef true terug
    }
    return false; // als de cart niet leeg is, geef false terug
}

/**
 * Formatteert de inhoud van de cart als een string.
 * @return string De inhoud van de cart als een string.
 */
function toString(): string
{
    $databaseConnection = connectToDatabase();
    $cart = getCart();  // haal de huidige cart op
    $string = "";  // maak een lege string aan
    foreach ($cart as $nr => $aantal) { // loop door de cart
        // query de productnaam uit de database
        $query = "SELECT StockItemName FROM stockitems WHERE StockItemID = $nr"; // maak een query die de productnaam ophaalt
        $statement = mysqli_prepare($databaseConnection, $query); // maak een verklaring van de query
        mysqli_stmt_execute($statement); // voer de query uit
        $result = mysqli_stmt_get_result($statement); // haal het resultaat op
        $row = mysqli_fetch_assoc($result); // haal de rij op
        $string .= $row["StockItemName"] . " x " . $aantal . "<br>"; // voeg de productnaam en het aantal toe aan de string
    }
    return $string; // geef de string terug
}