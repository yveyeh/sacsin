<?php
require_once('db/db_connect.php');

$data = $_POST;

$email = trim($data['email']);
$pass = trim($data['pass']);
$role = trim($data['role']);

$sql = "SELECT `email`, `role` FROM `user` WHERE `email` = '$email' AND `role` = '$role'";
$result = $connection->query($sql);
$a = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $a[] = $row;
    }
    echo json_encode($a);
} else {
    $a['error'] = "A user with these credentials wasn't found.";
    echo json_encode($a);
}

$connection->close();