<?php
require_once('db/db_connect.php');

$sql = "SELECT * FROM `object`";
$result = $connection->query($sql);
$a = array();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $a[] = $row;
    }
    echo json_encode($a);
} else {
    echo json_encode($a);
}

$connection->close();