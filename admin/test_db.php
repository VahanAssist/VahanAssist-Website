<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$host = 'localhost';
$user = 'u427642500_vahan';
$pass = 'Vahan@2026';
$db = 'u427642500_Vahan_db';

echo "Testing connection to $db...<br>";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";
$conn->close();
?>
