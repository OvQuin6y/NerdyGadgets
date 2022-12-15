<?php
include "database.php";

$databaseConnection = connectToDatabase();

function getPassword(mysqli $databaseConnection, $mail)
{
    $query = "
                SELECT Password
                FROM klant
                WHERE Email ='" . $mail .  "';";

    $result = $databaseConnection->query($query);
    $return = "";
    while ($row = $result->fetch_array()) {
        $return = $row["Password"];
    }
    return $return;
}

echo getPassword($databaseConnection, "thimo8123@gmail.com");
