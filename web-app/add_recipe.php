<?php 
	require('app/database/db.php');
	require('app/controllers/addrecipe.php');
?>

<!DOCTYPE html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/main-page.css">
	<link rel="stylesheet" href="assets/css/recipe-item.css">
	<link rel="stylesheet" href="assets/css/add-recipe.css">
	<link rel="stylesheet" href="assets/css/my-recipe.css">
	<title>Поиск рецептов</title>
</head>

<body>
	<?php require("app/include/header.php"); ?>
	<main>
		<div class="container">
			<form action="add_recipe.php" method="post" enctype="multipart/form-data">
				<div class="text-container">
					<h1>Основная информация</h1>
					<div class="main-info">
						<div class="inp-foto">
							<img src="assets/img/upload.svg">
							<input name="mainphoto" type="file" accept="image/*,image/jpeg">
						</div>
						<div class="main-info__else">
							<input name="name" type="text" required placeholder="Название" value="<?= $_POST['name'] ?? ''?>">
							<div class="selector">
								<label for="diff">Сложность</label>
								<select name="diff" id="diff">
									<option value="1" selected>1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</div>
							<div class="selector">
								<label for="time">Время приготовления</label>
								<input name="time" type="time" id="time" required>
							</div>
							<div class="selector">
								<label for="num">Количество порций</label>
								<input name="portition" type="number" id="num" required>
							</div>
						</div>
					</div>
				</div>

				<div class="text-container" style="margin-top: 10px;">
					<h1>Продукты</h1>
					<div class="ingridients">
						<template id="product-template">
							<div class="js-prod ingr">
								<select name="product[]">
									<?php
										$t = selectAll('products');
										for($i = 0; $i < count($t); $i++){
											echo '<option value="'.$t[$i]['id'].'">'.$t[$i]['title'].', '.$t[$i]['unit'].'</option>';
										}
										?>
								</select>
								<input name="count[]" type="number" required placeholder="Количество">
							</div>
						</template>
					</div>
					<div class="add-button add-prod"></div>
				</div>

				<div class="text-container" style="margin-top: 10px;">
					<h1>Шаги приготовления</h1>
					<div class="steps">
						<template id="steps-template">
							<div class="js-steps">
								<h2>Шаг</h2>
								<div class="step__item">
									<div class="inp-foto">
										<img src="assets/img/upload.svg">
										<input name="step-img[]" type="file" accept="image/*,image/jpeg">
									</div>
									<textarea name="step-text[]" required></textarea>
								</div>
							</div>
						</template>

					</div>
					<div class="add-button add-step"></div>
				</div>

				<input name="add" type="submit" value="Готово" class="add-submit">

			</form>

		</div>
	</main>
	<script src="assets/js/addRecipe.js"></script>
</body>