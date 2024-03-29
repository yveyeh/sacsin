<?php

/**
 * Generate a random string, using a cryptographically 
 * secure pseudorandom number generator (random_int).
 * @param int $length [optional] The number of characters in the generated string.
 * @param string $keyspace [optional] A string of all possible characters to select from.
 * @return string
 * @since 7.0
 */
function get_random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    ini_set('memory_limit', '1024M'); // or you could use 1G
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = array();
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces[] = $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

/**
 * Generates a Request package number.
 * @param mysqli $db The database connection.
 * @return string
 */
function generate_request_package_number($db): string
{
    try {
        // generate request package number
        $rp_num = get_random_str(8, '0123456789');
        // check that there's no duplication
        $res = mysqli_query($db, "SELECT id FROM request_packages WHERE package_number = '$rp_num'");
        if ($res->num_rows > 0):
            generate_request_package_number($db); // already exists so call back function.
        else:
            return $rp_num; // doesn't yet exist so return.
        endif;
    } catch (\Throwable $th) {
        throw $th;
    }
}

/**
 * Generates a Request ID.
 * @param mysqli $db The database connection.
 * @return string
 */
function generate_request_id($db): string
{
    try {
        // generate request id
        $request_id = get_random_str(6, '0123456789');
        // check that there's no duplication
        $res = mysqli_query($db, "SELECT `id` FROM `request_packages` WHERE `request_id` = '$request_id'");
        if ($res->num_rows > 0):
            generate_request_id($db); // already exists so call back function.
        else:
            return $request_id; // doesn't yet exist so return.
        endif;
    } catch (\Throwable $th) {
        throw $th;
    }
}

/**
 * Generates the id of a new user
 * to be inserted in the database.
 * @param mysqli $db The database connection.
 * @param string $role The user role.
 * @return string
 */
function generate_user_id($db, $role) {
    try {
        /**
         * The generated id for a new user
         * @var string $user_id
         */
        $user_id;
        //
        switch ($role) {
            case 'buyer':
                // generate user id
                $user_id = get_random_str(6, '0123456789');
                // check that there's no duplication
                $res = mysqli_query($db, "SELECT `id` FROM `user` WHERE `user_id` = '$user_id'"); 
                // check user id and take appropriate action.
                return check_user_id($db, $res, $user_id, $role);
                break;
            case 'seller':
                // generate user id
                $user_id = 'SI-' . get_random_str(4, '0123456789') . get_random_str(1, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                // check that there's no duplication
                $res = mysqli_query($db, "SELECT `id` FROM `user` WHERE `user_id` = '$user_id'");
                // check user id and take appropriate action.
                return check_user_id($db, $res, $user_id, $role);
                break;
            default:
                break;
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}

/**
 * Checks for the truthiness of the existence of a user id.
 * Returns the user id if it doesn't exist in the database.
 * @param mysqli $db The database connection.
 * @param \mysqli_result|bool $res The result from mysqli_query.
 * @param string $user_id The generated user id.
 * @param string $role The user role.
 */
function check_user_id($db, $res, $user_id, $role) {
    // user id already exists so recurse (by re-calling generate_user_id).
    if ($res->num_rows > 0):
        // unset variables in attempt to free memory they use.
        unset_vars([$user_id, $res]);
        // function call.
        generate_user_id($db, $role);
    // user id doesn't yet exist so return.
    else:
        return $user_id;
    endif;
}

/**
 * Unsets variable(s).
 * @param array $vars An array of variable(s)
 */
function unset_vars($vars) {
    foreach ($vars as $var) {
        unset($var);
    }
}

/**
 * Returns a name to be used for a file.
 * @param string $filename The name of the file to be exported.
 * @param string $extension [optional] The file extension.
 * @return string
 */
function make_export_filename($filename, $extension = 'scsn')
{
    $ext = ($extension[0] === '.') ? substr($extension, 1) : $extension;
    return $filename . '.' . $ext;
}

/**
 * Creates a file for export.
 * @param string $request_id The request id.
 * @param string $package_num The package number.
 * @param string $path The path to the export directory.
 * @return string|bool
 */
function create_request_export($request_id, $package_num, $path)
{
    try {
        // design file name
        $filename = 'SR-' . $request_id . '-' . (string) time();
        // exported file name.
        $file = make_export_filename($filename);
        // create file with the above name
        $open = fopen($path . $file, "w")  or die("Unable to open file!");
        // write data into the created file
        $data = array(
            "request_id" => $request_id,
            "package_number" => $package_num
        );
        foreach ($data as $key => $data_item) {
            $line = $key . "::" . $data_item . "\n";
            $write = fwrite($open, $line);
        }
        // close file
        $close = fclose($open);
        // return filename on success or false on failure
        return ($open !== false && $write !== false && $close !== false) ? $file : (bool) false;
    } catch (\Throwable $th) {
        //throw $th;
        // $a['error'] = "Request couldn't be exported";
        // echo json_encode($a);
    }
}

/**
 * 
 */
function import_request($db, $filename)
{
    #code...
}

/**
 * Returns an array of a specific request package.
 * @param mysqli $db The database connection.
 * @param int|string $id The id of the request package.
 * @return array
 */
function get_request_package_by_id($db, $id): array
{
    // get request package
    $result = mysqli_query($db, "SELECT * FROM `request_packages` WHERE `id` = $id");
    return mysqli_fetch_assoc($result);
}
