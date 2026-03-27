<?php
$conn = new mysqli('localhost', 'root', '', 'u427642500_Vahan_db');
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error . "\n";
    $conn = new mysqli('localhost', 'u427642500_vahan', 'Vahan@2026', 'u427642500_Vahan_db');
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query("DESCRIBE tbl_signup");
while($row = $result->fetch_assoc()) {
    echo $row['Field'] . " - " . $row['Type'] . "\n";
}
$conn->close();
?>
