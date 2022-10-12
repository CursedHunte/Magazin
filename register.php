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
if (!empty($_GET['login']) && !empty($_GET['password'])) {
	$login = $_GET['login'];
	$password = $_GET['password'];
	
	$sql = sprintf('SELECT `ID` FROM `users` WHERE `LOGIN` LIKE \'%s\' AND `PASSW` LIKE \'%s\'', $login,$password);
	$result = '{"user":';
	$stmt = $db->query($sql)->fetch();
	if (isset($stmt['ID'])) {
		$id = $stmt['ID'];
		
	}
	else {
		$result = '{"error": {"text": "Неверный логин/пароль"}}';
	}
}
else {
	$result = '{"error": {"text": "Не передан логин/пароль"}}';
}
echo $result;
?>