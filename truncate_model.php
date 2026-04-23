<?php
$f = 'd:/Sort/admin/application/models/Manage_product.php';
$c = file($f);
$new_count = 3569; 
$new_content = array_slice($c, 0, $new_count);
file_put_contents($f, implode('', $new_content) . "\n}\n");
echo "Done\n";
?>
