<?php
$mysqli = new mysqli("localhost", "root", "", "sort");
$res = $mysqli->query("DESCRIBE tbl_mp_custom_enquiry");
while ($row = $res->fetch_assoc()) { print_r($row); }
?>
