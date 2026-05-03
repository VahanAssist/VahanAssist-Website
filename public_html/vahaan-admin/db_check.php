<?php
$mysqli = new mysqli("localhost", "root", "", "vahan_db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

echo "=== USER PRATIK ===\n";
$res1 = $mysqli->query("SELECT id, firstName, lastName, email, type FROM tbl_signup WHERE firstName LIKE '%Pratik%' OR lastName LIKE '%Pratik%'");
if ($res1) {
    while ($row = $res1->fetch_assoc()) {
        print_r($row);
    }
}

echo "\n=== TRAILER BOOKINGS ===\n";
$res2 = $mysqli->query("SELECT id, userId, pickupLocation, dropLocation, bookingType, status FROM tbl_booking WHERE bookingType='TRAILER' ORDER BY id DESC LIMIT 10");
if ($res2) {
    while ($row = $res2->fetch_assoc()) {
        print_r($row);
    }
}
$mysqli->close();
?>
