<?php
require_once('db/db_connect.php');

$sql = "SELECT * FROM `request_packages`";
$result = $connection->query($sql);
$a = array();

if ($result) {
    while ($row = $result->fetch_object()) {
        array_push($a, array (
            "product" => $row->product, 
            "seller" => $row->seller, 
            "objects" => unserialize($row->objects),
            "last_edited" => $row->last_edited
        ));
        // $a[] = $row;
    }
    echo json_encode($a);
} else {
    echo json_encode($a);
}

$connection->close();