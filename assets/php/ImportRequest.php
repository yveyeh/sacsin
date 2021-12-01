<?php
require_once('db/db_connect.php');
require_once('functions/main.php');


$a = array();
$a['test'] = "test succ fail";
$a['message'] = "Msg rec.";
$a['file'] = $_FILES['file'];


// get the file name and set path
$file_name = $_FILES['file']['name'];
$file_path = './exports/' . $file_name;

// check for the existence of a file with same name and read the file if true.
$file_content = read_file($file_path);

// 
if (gettype($file_content) == 'array'):
    $c = [];
    foreach ($file_content as $fc):
        if ($fc):
            array_push($c, explode('::', $fc));
        endif;
    endforeach;
    // $a['content'] = $c[0][0];
    $req_id = $c[0][1];
    $pack_num = $c[1][1];
    $sql = "UPDATE `request_packages` SET `display` = true WHERE `request_id` = '$req_id' AND `package_number` = '$pack_num'";
    $update = mysqli_query($connection, $sql);
    $a['mysqli_query']['query'] = $sql;
    $a['mysqli_query']['result'] = $update;
endif;



/**
 * 
 */
function read_file($file_path) {
    try {
        if (file_exists($file_path)):
            // read file if there is
            $f = fopen($file_path, 'r');
            if ($f):
                $lines = [];
                // get lines in the file
                while (!feof($f)):
                    array_push($lines, trim(fgets($f)));
                endwhile;
                // close the file
                fclose($f);
                return $lines;
            else:
                return 'There was a problem while opening the file.';
            endif;
        else:
            return 'File could not be read since it was not found.';
        endif;
    } catch (\Throwable $th) {
        throw $th;
    }
}








echo json_encode($a);