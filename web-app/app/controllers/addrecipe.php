<?php
	if(isset($_POST['add'])){
		$mainphoto = $_FILES['mainphoto'];
		$name = $_POST['name'];
		$diff = $_POST['diff'];
		$time = $_POST['time'];
		$port = $_POST['portition'];

		$products = $_POST['product'];
		$count = $_POST['count'];

		$img = $_FILES['step-img'];
		$text = $_POST['step-text'];

		$resultText = [
			'Count' => count($text),
			'Steps' => []
		];

		for($i = 0; $i < count($text); $i++){
			$resultText['Steps'][$i] = $text[$i];
		}

		$lastId = selectLastId('recipes');
		$newId = $lastId['mx'] + 1;

		mkdir('recipe_src/rec'.$newId);
		
		$mainImgPath = 'recipe_src/rec'.$newId.'/'.mt_rand(0, 10000).$mainphoto['name'];
		copy($mainphoto['tmp_name'], $mainImgPath);

		// запись в файл
		$jsonData = json_encode($resultText, JSON_UNESCAPED_UNICODE);
		file_put_contents('t.json', $jsonData);

		$path = 'recipe_src/rec'.$newId.'/text.json';
		$jsonData = json_encode($resultText, JSON_UNESCAPED_UNICODE);
		file_put_contents('recipe_src/rec'.$newId.'/text.json', $jsonData);
		
		// $file = fopen($path, "w");
		// fwrite($file, json_encode($resultText, JSON_UNESCAPED_UNICODE));
		// fclose($textFile);

		$param = [
			'title' => $name,
			'author' => $_SESSION['name'].' '.$_SESSION['last_name'],
			'time' => $time,
			'difficult' => $diff, 
			'likes' => 0,
			'portions' => $port,
			'text' => '/'.$path,
			'img' => $mainImgPath
		];

		$id = insert('recipes', $param);
		insert('user_recipe', ['id_user' => $_SESSION['id'], 'id_recipe' => $id]);

		for($i = 0; $i < count($products); $i++){
			$param = [
				'id_recipe' => $id,
				'id_product' => $products[$i],
				'count' => $count[$i]
			];
			insert('product_recipe', $param);
		}


		for($i = 0; $i < count($img['name']); $i++){
			if($img['name'][$i] !== ''){
				$imgPath = 'recipe_src/rec'.$newId.'/'.mt_rand(0, 10000).$img['name'][$i];
				copy($img['tmp_name'][$i], $imgPath);
				$param = [
					'id_recipe' => $id,
					'part' => $i + 1,
					'img' => $imgPath
				];
				insert('img_recipe', $param);
			}
		}
		header('location: my_recipe.php');

	}