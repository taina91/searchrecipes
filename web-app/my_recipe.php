<?php 
	require('app/database/db.php');
?>

<!DOCTYPE html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/main-page.css">
	<link rel="stylesheet" href="assets/css/recipe-item.css">
	<link rel="stylesheet" href="assets/css/regauth.css">
	<link rel="stylesheet" href="assets/css/my-recipe.css">
	<title>Поиск рецептов</title>
</head>

<body>
	<?php require("app/include/header.php"); ?>
	<main>
		<div class="container">
			<a href="add_recipe.php" style="justify-self: center;  text-decoration: none;">
				<div class="add-recip-button">
					<div class="add-img"></div>
					<p class="add_p">Добавить рецепт</p>
				</div>
			</a>
			<?php 
				$myRecipe = selectAll('user_recipe', ['id_user' => $_SESSION['id']]);
				for($i = 0; $i < count($myRecipe); $i++):
			?>
			<div class="recipes__item">
				<?php $recipeItem = selectOne('recipes', ['id' => $myRecipe[$i]['id_recipe']])?>
				<div class="recipes__item__img">
					<img src="<?= $recipeItem['img'] ?>" alt="">
				</div>
				<div class="recipes__item__info">
					<div class="info__title">
						<h2 class="title"><?= $recipeItem['title'] ?></h2>
						<p class="author">Автор: <?= $recipeItem['author'] ?></p>
					</div>
					<div class="info__characteristic">
						<div class="ingredients">
							<?php echo countProduct($recipeItem['id']). ' ингредиентов';?>
						</div>
						<div class="times"><?= $recipeItem['time'] ?></div>
						<div class="difficult">
							Сложность
							<div class="difficult__circle">
								<?php for($j = 0; $j < 5 - $recipeItem['difficult']; $j++):?>
								<div class="circle"></div>
								<?php endfor;?>
								<?php for($j = 0; $j < $recipeItem['difficult']; $j++):?>
								<div class="circle set"></div>
								<?php endfor;?>
							</div>
						</div>
					</div>
					<div class="info__tags">
						<?php 
							$tags = resipeTags($recipeItem['id']);
							for($j = 0; $j < count($tags); $j++){
								echo '<p class="tag">#'.$tags[$j]['title'].'</p>';
							}
						?>
					</div>
				</div>
				<div class="recipes__item__flags" style="align-items: center; cursor: pointer;">
					<div class="flag" style="margin: 3px;"><img src="assets/img/edit.svg"></div>
					<div class="flag-title">Редактировать</div>

					<div class="flag"><img src="assets/img/delete.svg"></div>
					<div class="flag-title">Удалить</div>
				</div>
			</div>
			<?php endfor;?>
		</div>
	</main>
</body>