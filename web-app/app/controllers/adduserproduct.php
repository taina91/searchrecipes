<?php
	if(isset($_POST['add-button'])){
		$count = trim($_POST['count']);
		$product = $_POST['product'];

		$exisit = selectOne('users_products', ['id_user' => $_SESSION['id'], 'id_product' => $product]);
		if($exisit['id_product'] === $product){
			$count = $count + $exisit['count'];
			$where = ['id_user' => $_SESSION['id'], 'id_product' => $product];
			$post = [
				'count' => $count
			];
			update('users_products', $where, $post);
		}
		else{
			if($count !== ''){
				$post = [
					'id_user' => $_SESSION['id'],
					'id_product' => $product, 
					'count' => $count
				];
				$id = insert('users_products', $post);
			}
			header('location: fridge.php');
		}
	}
	if(isset($_POST['add-new-button'])){
		$unit = trim($_POST['unit']);
		$product = trim($_POST['new-prod']);
		$count = trim($_POST['new-count']);
		$exisit = selectOne('products', ['title' => $product]);
		if($exisit['title'] === $product){
			$errMsg = "Такой продукт уже существует";
			if($count !== '' && $product !== ''){
				$post = [
					'id_user' => $_SESSION['id'], 
					'id_product' => $exisit['id'], 
					'count' => $count 
				];
				$id = insert('users_products', $post); 
				header('location: fridge.php'); 
			}
		}
		else{
			if($product !== ''){
				$post = [
					'title' => $product, 
					'unit' => $unit 
				];
				$id = insert('products', $post); 
				$post = [
					'id_user' => $_SESSION['id'],
					'id_product' => $id, 
					'count' => $count
				];
				$id = insert('users_products', $post);
				header('location: fridge.php');
			}
		}
	}
?>