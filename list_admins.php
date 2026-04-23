<?php
$conn = new mysqli('localhost', 'u427642500_vahan', 'Vahan@2026', 'u427642500_Vahan_db');
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
$result = $conn->query("SELECT email FROM tbl_admin_login LIMIT 5");
while($row = $result->fetch_assoc()) { echo $row['email'] . "\n"; }
$conn->close();
?>
