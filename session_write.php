<?php

if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['lang'] = $_GET['nieuw_lang'];


