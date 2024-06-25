<?php
	require('app/database/db.php');
	$id_prod = $_GET["id"];
	$param = [
		'id_product' => $_GET['id'],
		'id_user' => $_SESSION['id']
	];
	delete("users_products", $param);
	header('location: fridge.php');
?>