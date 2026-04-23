<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establish connection
$mysqli = new mysqli("localhost", "root", "", "test"); // We dont know the local DB name or if its running
print_r("Local DB requires testing\n");
?>
