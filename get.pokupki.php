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
$result ='';
if (isset($_GET['token'])) {
	$token = $_GET['token'];
	$sql = sprintf('SELECT `ID` FROM `users` WHERE `TOKEN` LIKE \'%s\' AND `EXPIRED` > CURRENT_TIMESTAMP', $token);
	$stmt = $db->query($sql)->fetch();
	if (isset($stmt['ID'])) {
		$id_user = $stmt['ID'];
		$result = '("pokupki":[';
		$sql = sprintf('SELECT s.ID,s.TITLE,s.DESCRIPTION,s.PRICE,k.COUNT,kat.NAME FROM `korzina` AS k JOIN `Goods` AS s ON k.ID_TOVAR = s.ID JOIN `Category` AS kat ON s.ID_CAT = kat.ID WHERE `ID_USER` = 1; = $d', $id_user);
		$stmt = $db->query($sql);
		while ($row = $stmt->fetch()) {
			$result .= '{';
			$result .= '"id":'.$row['ID'].',"title":"'.$row['TITLE'].'","desc":"'.$row['DESCRIPTION'].'","price":'.$row['PRICE'].',"count":'.$row['COUNT'];
			$result .= '},';
		}
		$result = rtrim($result, ",");
		$result .= ']}';
	}
	else {
		$result = '{"error": {"text": "Неверный или просроченный токен"}}';
	}
}
else {
	$result = '{"error": {"text": "Не передан"}}';
}
echo $result;
?>