<?php

// Establishing Connection with Server
$connection = mysqli_connect("localhost", "root", "@Root123#");

// Checking Server connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error($connection));
} //else {echo "Connected to server! ";}

// change character set to utf8 
if (!mysqli_set_charset($connection, "utf8")) {
    printf("Error loading character set utf8: %s\n", mysqli_connect_error($connection));
} else {
    // printf("Current character set: %s\n", mysqli_character_set_name($connection));
}

// Selecting Database
$db = mysqli_select_db($connection, "sacsin_db");

// Checking Database selection
if (!$db) {
    die("Database selection failed: " . mysqli_connect_error($connection));
} //else {echo "Connected to database!";}

?>