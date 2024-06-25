<?php
	require('app/database/db.php');
	if(isset($_GET["id"])){
		$id_product = $_GET["id"];
		$param = $_GET["param"];
		if($param == 1){
			update('products', ['id' => $id_product], ['validly' => 1]);
		}
		elseif($param == 0){
			delete('products', ['id' => $id_product]);
		}
	}
	elseif(isset($_POST['del-butt'])){
		$t = $_POST['delete'];
		for($i = 0; $i < count($t); $i++){
			delete('products', ['id' => $t[$i]]);
		}
	}
	header('location: admin.php?product=Модерировать+продукты');
?>
