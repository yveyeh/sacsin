<?php
require_once('db/db_connect.php');

$data = $_POST;

$product = trim($data['selected_product']);
$seller = trim($data['selected_seller']);
$objects = serialize($data['objects']);

$sql = "INSERT INTO request_packages (product, seller, objects, last_edited) VALUES ('$product', '$seller', '$objects', '3 mins')";
// $result = $connection->query($sql);
$result = mysqli_query($connection, $sql);
$a = array();

if ($result) {
    // while ($row = $result->fetch_assoc()) {
        $a[] = "Success";
    // }
    echo json_encode($a);
} else {
    $a['error'] = "Request Package couldn't be created...";
    echo json_encode($a);
}

mysqli_close($connection); // close connection