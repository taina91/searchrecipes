<?php

$host = "localhost:3306";
$user = "zitinataina_admin";
$password = "tvAdmin";
$db = "zitinataina_search_recipes";
$charset = 'utf8';
$option = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
	$pdo = new PDO(
		"mysql:host=$host;dbname=$db;charset=$charset", 
		$user, $password, $option
	);
}
catch(PDOException $e){
	echo $e;
	die("Ошибка подключения к базе данных");
}

// простой стиль
$con = mysqli_connect($host, $user, $password, $db);
// объектный стиль
$mysqli = new mysqli($host, $user, $password, $db);

?>