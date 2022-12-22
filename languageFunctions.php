<?php

function getTranslation(mysqli $databaseConnection, string $lang, string $kolom)
{
    $query = "SELECT " . $lang . " as Kolom FROM translation_table WHERE name = '" . $kolom . "';";
    $result = $databaseConnection->query($query);
    $kopOverzicht = "";
    while ($row = $result->fetch_array()) {
        $kopOverzicht = $row["Kolom"];
    }
    return $kopOverzicht;
}
