<?php
require_once('db/db_connect.php');

$data = $_POST;

$name = $data['selected_object'];
$_resp = trim($data['request_response'][0]);

$sql = "INSERT INTO `object` (`name`, response_sentence, last_edited, alert_status) VALUES ('$name', '$_resp', '3 mins', 'success')";
// $result = $connection->query($sql);
$result = mysqli_query($connection, $sql);
$a = array();

if ($result) {
    // while ($row = $result->fetch_assoc()) {
        $a[] = "Success";
    // }
    echo json_encode($a);
} else {
    $a['error'] = "Object couldn't be created...";
    echo json_encode($a);
}

mysqli_close($connection); // close connection