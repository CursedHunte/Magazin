<?php
$host = 'db';
$db_name = 'Shop';
$db_user = 'root';
$db_pas = 'A2D4';

try {
	$db = new PDO('mysql:host='.$host.';dbname='.$db_name,$db_user,$db_pas);
}
catch (PDOExpeption $e) {
	print "error: " . $e->getMessage();
	die();
}

$stmt = $db->query("SELECT s.`ID`, `TITLE`, `DESCRIPTION`, `PRICE`, `COUNT`, `ID_CAT` FROM `Goods` AS s");
echo '<table>';
	echo '<tr>';
		echo '<td>ID</td>';
		echo '<td>Название</td>';
		echo '<td>Описание</td>';
		echo '<td>Цена</td>';
		echo '<td>Количество</td>';
		echo '<td>Категория</td>';
	echo '</tr>';
while ($row = $stmt->fetch()) {
	echo '<tr>';
		echo '<td>'.$row['ID'].'</td>';
		echo '<td>'.$row['TITLE'].'</td>';
		echo '<td>'.$row['DESCRIPTION'].'</td>';
		echo '<td>'.$row['PRICE'].'</td>';
		echo '<td>'.$row['COUNT'].'</td>';
		echo '<td>'.$row['ID_CAT'].'</td>';
	echo '</tr>';
}
?>