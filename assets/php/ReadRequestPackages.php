<?php
require_once('db/db_connect.php');

$sql = "SELECT * FROM `request_packages`";
$result = $connection->query($sql);
$a = array();

if ($result) {
    while ($row = $result->fetch_object()) {
        array_push($a, array (
            "package_number" => $row->package_number,
            "request_id" => $row->request_id,
            "product" => $row->product, 
            "buyer" => $row->buyer, 
            "seller" => $row->seller, 
            "objects" => unserialize($row->objects),
            "last_edited" => $row->last_edited,
            "exp_file" => $row->exp_file,
            "status" => $row->status, 
            "display" => $row->display
        ));
        // $a[] = $row;
    }
    echo json_encode($a);
} else {
    echo json_encode($a);
}

$connection->close();