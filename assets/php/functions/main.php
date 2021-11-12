<?php

/**
 * Generates a Request package number.
 * @param mysqli $db The database connection.
 * @return string
 */
function generate_request_package_number($db) {
    return '';
}

/**
 * Returns a name to be used for a file.
 * @param string $filename The name of the file to be exported.
 * @param string $extension [optional] The file extension.
 * @return string
 */
function make_export_filename($filename, $extension = 'scsn') {
    $ext = ($extension[0] === '.') ? substr($extension, 1) : $extension;
    return $filename . '.' . $ext;
}

/**
 * Creates a file for export.
 * @param mysqli $db The database connection.
 * @param int|string $id The id of the request package.
 * @param string $path The path to the export directory.
 * @return bool
 */
function export_request($db, $id, $path) {
    try {
            // get reference of data to export
            $req =  get_request_package_by_id($db, $id)['request_id'];
            // design file name
            $filename = 'SR-' . $req . '-' . (string) time();
            // exported file name.
            $file = make_export_filename($filename);
            // create file with the above name
            $export = fopen($path . $file, "w")  or die("Unable to open file!");
            // write data into the created file
            $txt = "Test line one\n";
            fwrite($export, $txt);
            $txt = "Test line two\n";
            fwrite($export, $txt);
            // close file to export
            return fclose($export);
    } catch (\Throwable $th) {
        //throw $th;
        // $a['error'] = "Request couldn't be exported";
        // echo json_encode($a);
    }
}

/**
 * 
 */
function import_request() {
    #code...
}

/**
 * Returns an array of a specific request package.
 * @param mysqli $db The database connection.
 * @param int|string $id The id of the request package.
 * @return array
 */
function get_request_package_by_id($db, $id): array {
    // get request package
    $result = mysqli_query($db, "SELECT * FROM `request_packages` WHERE `id` = $id");
    return mysqli_fetch_assoc($result);
}