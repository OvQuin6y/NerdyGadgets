<?php
include __DIR__ . "/header.php";
include "cartfuncties.php";

unset($_SESSION["klantID"]);
header("Location: index.php");
