<?php

function getTemperature($db) {
    $query = "SELECT Temperature AS t FROM coldroomtemperatures  WHERE ColdRoomSensorNumber = 5";
    $statement = mysqli_prepare($db, $query);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $row = mysqli_fetch_assoc($result);
    return $row["t"];
}
