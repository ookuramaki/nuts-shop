<?php require '../header.php'; ?>
<?php
	require 'connect.php';
$sql = 'select * from product';
$stmt = $pdo->query($sql);
var_dump($stmt);

foreach ( $stmt as $row) {
	echo '<p>';
	echo $row['id'], ':';
	echo $row['name'], ':';
	echo $row['price'];
	echo '</p>';
}
?>
<?php require '../footer.php'; ?>
