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
$result ='{"responde":[';
$stmt = $db->query("SELECT s.`ID`, `TITLE`, `DESCRIPTION`, `PRICE`, `COUNT`, `ID_CAT` FROM `Goods` AS s JOIN `Category` AS c ON s.ID_CAT=c.ID");
while ($row = $stmt->fetch()) {
	$result .= '{';
    $result .= '"id":'.$row['ID'].',"title":"'.$row['TITLE'].'","desc":"'.$row['DESCRIPTION'].'","price":'.$row['PRICE'].',"count":'.$row['COUNT'].',"kat":"'.$row['ID_CAT'].'"';
	$result .= '},';
}
$result = rtrim($result, ",");
$result .= ']}';
echo $result;
?>