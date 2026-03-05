<?php
$mysqli = new mysqli("localhost", "root", "", "vahan_db");
if ($mysqli->connect_errno) {
    echo json_encode(["error" => "Failed to connect"]);
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
    $res2 = $mysqli->query("SELECT id, userId, pickupLocation, dropLocation, bookingType, status FROM tbl_booking WHERE userId IN ($userIdsStr) ORDER BY id DESC");
    if ($res2) {
        while ($row = $res2->fetch_assoc()) {
            $pratikBookings[] = $row;
        }
    }
}

echo json_encode([
    "users" => $pratikUsers,
    "bookings_by_user_id" => $pratikBookings
]);
$mysqli->close();
?>
