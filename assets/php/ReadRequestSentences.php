<?php
require_once('db/db_connect.php');

$table = trim($_POST['table']);
$table = mysqli_escape_string($connection, $table);

$sql = "SELECT * FROM $table";
$result = $connection->query($sql);
$a = array();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $a[] = $row;
    }
    echo json_encode($a);
} else {
    $a['message'] = "No data found";
    echo json_encode($a);
}

$connection->close();