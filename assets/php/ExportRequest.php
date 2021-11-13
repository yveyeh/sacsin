<?php
require_once('db/db_connect.php');
require_once('./functions/main.php');

// echo '<b>Who I am: </b>' . exec('whoami') . "<br/>"; 

// print_r($_SERVER);

$string = __FILE__;
$pos = strrpos($string,"/");
// echo $pos;
$path = substr($string, 0, $pos) . '/exports/';

// echo (string) time();

echo generate_request_id($connection);

// exit();

// create_request_export($connection, 7, $path);

// echo '<br><br>';

// echo __FILE__;

// $data = $_POST;

// $name = $data['selected_object'];
// $_resp = trim($data['request_response'][0]);

// $sql = "INSERT INTO `object` (`name`, response_sentence, last_edited, alert_status) VALUES ('$name', '$_resp', '3 mins', 'success')";
// $result = $connection->query($sql);
// $result = mysqli_query($connection, $sql);
// $a = array();

// if ($result) {
//     // while ($row = $result->fetch_assoc()) {
//         $a[] = "Success";
//     // }
//     echo json_encode($a);
// } else {
//     $a['error'] = "Object couldn't be created...";
//     echo json_encode($a);
// }

//mysqli_close($connection); // close connection