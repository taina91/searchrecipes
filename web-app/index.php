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
	<link rel="stylesheet" href="assets/css/select-panel.css">
	<title>Поиск рецептов</title>
</head>

<body>
	<?php require("app/include/header.php"); ?>
	<main>
		<div class="options hidden">
			<div>
				<p class="options__title">Установите параметры рецептов</p>
				<form class="option__form" method="get">
					<?php if(isset($_SESSION['id'])):?>
					<fieldset class="chek">
						<legend>По моим продуктам</legend>
						<input id="from_mine" type="checkbox" readonly> Да
					</fieldset>
					<?php endif;?>
					<fieldset>
						<legend>Выберите теги</legend>
						<select name="tag">
							<option value="0" selected>Все</option>
							<?php 
							$t = selectAll('tags');
							for($i = 0; $i < count($t); $i++){
								echo '<option value="'.$t[$i]['id'].'">'.$t[$i]['title'].'</option>';
							}
						?>
						</select>
					</fieldset>
					<fieldset>
						<legend>Выберите продукты</legend>
						<select name="product">
							<option value="0" selected>Все</option>
							<?php 
							$t = selectAll('products', ['validly' => 1]);
							for($i = 0; $i < count($t); $i++){
								echo '<option value="'.$t[$i]['id'].'">'.$t[$i]['title'].'</option>';
							}
						?>
						</select>
					</fieldset>
					<input type="submit" name="start_searth" value="Найти рецепт">
				</form>
				<!-- <div class="options__selected">
				<div class="selected">
					Выбранные теги
				</div>
				<div class="selected">
					Выбранные продукты
				</div>
			</div> -->
			</div>
		</div>
		<div class="options__button">
			Найди рецепт для себя
		</div>
		<div class="container">
			<div class="text-container">
				<h1 class="intro_h1">Лучшие рецепты специально для вас</h1>
				<p class="intro_p">Ищите рецепты, указывая теги и включая нужные ингредиенты: просто начните
					писать его название и сайт сам подберет соответствующий.</p>
				<?php if(isset($_SESSION['id'])):?>
				<p class="intro_p">Теперь вам доступна функция “По моим продуктам” для этого
					заполните ваш холодильник и поставьте галочку в соответствующей строке поиска. Сайт подберет
					для вас только те рецепты, в которых используются только те ингредиенты, которые уже есть у вас дома.</p>
				<?php else:?>
				<p class="intro_p">После регистрации будет доступна функция “По моим продуктам” для этого зайдите просто
					заполните
					ваш холодильник в личном кабинете и поставьте галочку в соответствующей строке поиска. Сайт подберет
					для вас только те рецепты, в которых используются только те ингредиенты, которые уже есть у вас дома.</p>
				<?php endif;?>
			</div>
			<div class="recipes">
				<?php if(isset($_GET['start_searth'])){
							$tag = $_GET["tag"];
							$product = $_GET["product"];
							$t = selectRecipe($_GET["tag"], $_GET["product"]);
						}
						else{
							$t = selectAll('recipes', ['validly' => 1]);
						}
			?>
				<?php for($i = 0; $i < count($t); $i++):?>
				<div class="recipes__item">
					<div class="recipes__item__img">
						<img src="<?= $t[$i]['img'] ?>" alt="">
					</div>
					<div class="recipes__item__info">
						<div class="info__title">
							<a class="link" style="text-decoration: none; color: black;"
								href="recipe_page.php?id=<?= $t[$i]['id'] ?>">
								<h2 class="title"><?= $t[$i]['title'] ?></h2>
							</a>
							<p class="author">Автор: <?= $t[$i]['author'] ?></p>
						</div>
						<div class="info__characteristic">
							<div class="ingredients">
								<?php echo countProduct($t[$i]['id']). ' ингредиентов';?>
							</div>
							<div class="times"><?= $t[$i]['time'] ?></div>
							<div class="difficult">
								Сложность
								<div class="difficult__circle">
									<?php for($j = 0; $j < 5 - $t[$i]['difficult']; $j++){
									echo '<div class="circle"></div>';
								}?>
									<?php for($j = 0; $j < $t[$i]['difficult']; $j++){
									echo '<div class="circle set"></div>';
								}?>
								</div>
							</div>
						</div>
						<div class="info__tags">
							<?php 
							$tags = resipeTags($t[$i]['id']);
							for($j = 0; $j < count($tags); $j++){
								echo '<p class="tag">#'.$tags[$j]['title'].'</p>';
							}
						?>
						</div>
					</div>
					<div class="recipes__item__flags">
						<div class="flag" style="margin: 3px;"><img src="assets/img/flag.svg"></div>
						<div class="flag-title">Сохранить</div>
						<div class="flag"><img src="assets/img/like.svg"></div>
						<div class="flag-title"><?= $t[$i]['likes'] ?></div>
					</div>
				</div>
				<?php endfor;?>
			</div>
		</div>
	</main>
	<script src="assets/js/options.js"></script>
	<script src="assets/js/regauth.js"></script>
</body>