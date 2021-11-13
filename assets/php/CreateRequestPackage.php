<?php
require_once('db/db_connect.php');
require_once('./functions/main.php');

$data = $_POST;

$package_num = generate_request_package_number($connection);
$request_id = generate_request_id($connection);
$product = trim($data['selected_product']);
$seller = trim($data['selected_seller']);
$objects = serialize($data['objects']);

// create request export
$string = __FILE__;
$pos = strrpos($string,"/");
$path = substr($string, 0, $pos) . '/exports/';
$exp_file = create_request_export($request_id, $package_num, $path);

// check $exp_file

$sql = "INSERT INTO request_packages (id, package_number, request_id, product, seller, objects, last_edited, exp_file) 
VALUES (DEFAULT, '$package_num', '$request_id', '$product', '$seller', '$objects', '3 mins', '$exp_file')";
// $result = $connection->query($sql);
$result = mysqli_query($connection, $sql);
$a = array();

if ($result) {
        $a['status'] = "success";
        $a['message'] = "Request Package has been created.";
    echo json_encode($a);
} else {
    $a['status'] = "error";
    $a['message'] = "Request Package could not be created.";
    $a['mysqli'] = array('result' => $result, 'error' => mysqli_error($connection));
    echo json_encode($a);
}

mysqli_close($connection); // close connection