<?php
$mysqli = new mysqli("localhost", "root", "", "vahan_db");
if ($mysqli->connect_errno) {
    file_put_contents('db_dump.txt', "Failed to connect to MySQL: " . $mysqli->connect_error);
    exit();
}

$pratikUsers = [];
$res1 = $mysqli->query("SELECT id, firstName, email, phoneNumber FROM tbl_signup WHERE firstName LIKE '%Pratik%' OR email LIKE '%Pratik%'");
if ($res1) {
    while ($row = $res1->fetch_assoc()) {
        $pratikUsers[] = $row;
    }
}

$userIdsStr = "";
if (count($pratikUsers) > 0) {
    $userIds = array_column($pratikUsers, 'id');
    $userIdsStr = implode(",", $userIds);
}

$pratikBookings = [];
if ($userIdsStr !== "") {
    $res2 = $mysqli->query("SELECT id, userId, pickupLocation, dropLocation, bookingType, status FROM tbl_booking WHERE userId IN ($userIdsStr) ORDER BY id DESC LIMIT 10");
    if ($res2) {
        while ($row = $res2->fetch_assoc()) {
            $pratikBookings[] = $row;
        }
    }
}

$allBookings = [];
$res3 = $mysqli->query("SELECT id, userId, pickupLocation, dropLocation, bookingType, status FROM tbl_booking WHERE bookingType='TRAILER' ORDER BY id DESC LIMIT 5");
if ($res3) {
    while ($row = $res3->fetch_assoc()) {
        $allBookings[] = $row;
    }
}

$out = json_encode([
    "pratik_users" => $pratikUsers,
    "pratiks_trailers" => $pratikBookings,
    "last_5_trailers_overall" => $allBookings
]);

file_put_contents('d:/Sort/admin/db_test_output.txt', $out);
$mysqli->close();
?>
