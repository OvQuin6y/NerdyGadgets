<?php

$stockItemId = 5;

echo "<a href='view.php?id=$stockItemId'>";

function checkMail(mysqli $databaseConnection, $mail)
{
    $query = "
                SELECT COUNT(*) aantal
                FROM klant
                WHERE Email ='" . $mail .  "';";

    $result = $databaseConnection->query($query);
    $return = "";
    while ($row = $result->fetch_array()) {
        $return = $row["aantal"];
    }
    if ($return == 1) {
        return "TRUE";
    } else {
        return "FALSE";
    }
}

