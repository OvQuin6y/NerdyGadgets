<?php


if(!isset($_SESSION))
{
    session_start();
}                                // altijd hiermee starten als je gebruik wilt maken van sessiegegevens

function getCart()
{
    if (isset($_SESSION['cart'])) {               //controleren of winkelmandje (=cart) al bestaat
        $cart = $_SESSION['cart'];                  //zo ja:  ophalen
    } else {
        $cart = array();                            //zo nee: dan een nieuwe (nog lege) array
    }
    return $cart;                               // resulterend winkelmandje terug naar aanroeper functie
}

function saveCart($cart)
{
    $_SESSION["cart"] = $cart;                  // werk de "gedeelde" $_SESSION["cart"] bij met de meegestuurde gegevens
}

function addProductToCart($stockItemID)
{
    $cart = getCart();                          // eerst de huidige cart ophalen

    if (array_key_exists($stockItemID, $cart)) {  //controleren of $stockItemID(=key!) al in array staat
        $cart[$stockItemID] += 1;                   //zo ja:  aantal met 1 verhogen
    } else {
        $cart[$stockItemID] = 1;                    //zo nee: key toevoegen en aantal op 1 zetten.
    }

    saveCart($cart);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
}

function removeProductFromCart($stockItemID)
{
    $cart = getCart();                          // eerst de huidige cart ophalen

    if (array_key_exists($stockItemID, $cart)) {  //controleren of $stockItemID(=key!) al in array staat
        $cart[$stockItemID] -= 1;                   //zo ja:  aantal met 1 verlagen
    } else {
        $cart[$stockItemID] = 1;                    //zo nee: key toevoegen en aantal op 1 zetten.
    }

    saveCart($cart);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
}

function deleteProductFromCart($stockItemID)
{
    $cart = getCart();                          // eerst de huidige cart ophalen

    if (array_key_exists($stockItemID, $cart)) {  //controleren of $stockItemID(=key!) al in array staat
        unset($cart[$stockItemID]);                   //zo ja:  aantal met 1 verlagen
    }

    saveCart($cart);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
}

function setProductInCart($stockItemID,$amount)
{
    $cart = getCart();                          // eerst de huidige cart ophalen
    $cart[$stockItemID] = $amount;

    saveCart($cart);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
}

function clearCart()
{
    $cart = getCart();  // haal de huidige cart op

    foreach ($cart as $nr => $aantal) { // loop door de cart
        deleteProductFromCart($nr);  // verwijder elk product uit de cart
    }
}

function isCardEmpty(): bool
{
    $cart = getCart();  // haal de huidige cart op

    if (count($cart) == 0) {  // kijk of de cart leeg is
        return true; // als de cart leeg is, geef true terug
    }
    return false; // als de cart niet leeg is, geef false terug
}

function toString() {
    $cart = getCart();  // haal de huidige cart op
    $string = "";  // maak een lege string aan
    foreach ($cart as $nr => $aantal) { // loop door de cart
        $string .= $nr . " " . $aantal . " ";  // voeg de producten toe aan de string
    }
    return $string; // geef de string terug
}