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
	<link rel="stylesheet" href="assets/css/fridge.css">
	<link rel="stylesheet" href="assets/css/admin.css">
	<title>Поиск рецептов</title>
</head>

<body>
	<?php require("app/include/header.php"); ?>
	<main>
		<div class="container">
			<form class="panel" method="get" action="admin.php">
				<?php if($_SESSION['role'] == 'admin'):?>
				<input name="users" type="submit" value="Редактировать привелегии" class="panel__button">
				<?php endif;?>
				<input name="recipe" type="submit" value="Модерировать рецепты" class="panel__button">
				<input name="product" type="submit" value="Модерировать продукты" class="panel__button">
			</form>

			<?php if(isset($_GET['users'])):?>
			<div class="text-container">
				<?php $user = view('about_users');?>
				<table class="prod-talbe">
					<thead>
						<tr>
							<th>ID</th>
							<th>Имя</th>
							<th>Фамилия</th>
							<th>Email</th>
							<th>Роль</th>
							<th>Редактировать привелегии</th>
						</tr>
					</thead>
					<?php for($i = 0; $i < count($user); $i++):?>
					<tr>
						<td><?= $user[$i]['id']?></td>
						<td><?= $user[$i]['first_name']?></td>
						<td><?= $user[$i]['last_name']?></td>
						<td><?= $user[$i]['email']?></td>
						<td><?= $user[$i]['role']?></td>

						<?php if($user[$i]['role'] == 'user'):?>
						<td><a href="editprivilege.php?id=<?= $user[$i]['id'] ?>&param=1">Назначить сотрудником</a></td>
						<?php elseif($user[$i]['role'] == 'employee'):?>
						<td><a href="editprivilege.php?id=<?= $user[$i]['id'] ?>&param=0">Удалить сотрудника</a></td>
						<?php elseif($user[$i]['role'] == 'admin'):?>
						<td>Нельзя редактировать</td>
						<?php endif;?>
					</tr>
					<?php endfor;?>
				</table>
			</div>
			<?php endif;?>
			<?php if(isset($_GET['recipe']) || isset($_GET['some-recipe-button'])):?>
			<div class="text-container">
				<form method="get" action="admin.php" style="display: grid; grid-template-columns: 1fr 100px;">
					<select name="some-recipe" style="margin: 20px 0;">
						<option value="1" 
								<?php if(isset($_GET['some-recipe'])) {echo ($_GET['some-recipe']==1) ? "selected" : "";}?>
						>Все рецепты</option>
						<option value="2" 
								<?php if(isset($_GET['some-recipe'])) {echo ($_GET['some-recipe']==2) ? "selected" : "";}?>
						>Не подтвержденные рецепты</option>
						<option value="3" 
								<?php if(isset($_GET['some-recipe'])) {echo ($_GET['some-recipe']==3) ? "selected" : "";}?>
						>Подтвержденные рецепты</option>
					</select>
					<input name="some-recipe-button" type="submit" value="OK" class="panel__button">
				</form>
				<?php 
					if(isset($_GET['some-recipe'])){
						if($_GET['some-recipe'] == 1)
							$user = selectAll('recipes');
						elseif($_GET['some-recipe'] == 2)
							$user = view('no_validly_recipes');
						elseif($_GET['some-recipe'] == 3)
							$user = selectAll('recipes', ['validly' => 1]);
					}else{
						$user = selectAll('recipes');
					}?>
				<form method="post" action="editrecipe.php">
				<table class="prod-talbe s">
					<thead>
						<tr>
							<th>ID</th>
							<th>Название</th>
							<th>Автор</th>
							<th>Редактировать</th>
							<th>Удалить</th>
						</tr>
					</thead>
					<?php for($i = 0; $i < count($user); $i++):?>
					<tr>
						<td><?= $user[$i]['id']?></td>
						<td><?= $user[$i]['title']?></td>
						<td><?= $user[$i]['author']?></td>
						<?php if($user[$i]['validly'] == 0):?>
						<td><a href="editrecipe.php?id=<?= $user[$i]['id'] ?>&param=1">Подтвердить</a>
							<a href="editrecipe.php?id=<?= $user[$i]['id'] ?>&param=0">Удалить</a>
						</td>
						<?php else:?>
						<td><a href="editrecipe.php?id=<?= $user[$i]['id'] ?>&param=0">Удалить</a>
						</td>
						<?php endif;?>
						<td><input type="checkbox" name="delete[]" value="<?= $user[$i]['id']?>"></td>
					</tr>
					<?php endfor;?>
				</table>
					<input name="del-butt" type="submit" value="Удалить выбранные" class="del-but">
					</form>
			</div>
			<?php endif;?>
			<?php if(isset($_GET['product']) || isset($_GET['some-prod-button'])):?>
			<div class="text-container">
				<form method="get" action="admin.php" style="display: grid; grid-template-columns: 1fr 100px;">
					<select name="some-prod" style="margin: 20px 0;">
						<option value="1" 
								<?php if(isset($_GET['some-prod'])) {echo ($_GET['some-prod']==1) ? "selected" : "";}?>
						>Все продукты</option>
						<option value="2" 
								<?php if(isset($_GET['some-prod'])) {echo ($_GET['some-prod']==2) ? "selected" : "";}?>
						>Не подтвержденные продукты</option>
						<option value="3" 
								<?php if(isset($_GET['some-prod'])) {echo ($_GET['some-prod']==3) ? "selected" : "";}?>
						>Подтвержденные продукты</option>
					</select>
					<input name="some-prod-button" type="submit" value="OK" class="panel__button">
				</form>
				<?php 
					if(isset($_GET['some-prod'])){
						if($_GET['some-prod'] == 1)
							$prod = selectAll('products');
						elseif($_GET['some-prod'] == 2)
							$prod = view('no_validly_product');
						elseif($_GET['some-prod'] == 3)
							$prod = selectAll('products', ['validly' => 1]);
					}else{
						$prod = selectAll('products');
					}?>
				<form method="post" action="editproduct.php">
				<table class="prod-talbe">
					<thead>
						<tr>
							<th>ID</th>
							<th>Продукт</th>
							<th>Ед. измерения</th>
							<th>Редактировать</th>
							<th>Удалить</th>
						</tr>
					</thead>
					<?php for($i = 0; $i < count($prod); $i++):?>
					<tr>
						<td><?= $prod[$i]['id']?></td>
						<td><?= $prod[$i]['title']?></td>
						<td><?= $prod[$i]['unit']?></td>
						
						<?php if($prod[$i]['validly'] == 0):?>
						<td><a href="editproduct.php?id=<?= $prod[$i]['id'] ?>&param=1">Подтвердить</a>
							<a href="editproduct.php?id=<?= $prod[$i]['id'] ?>&param=0">Удалить</a>
						</td>
						<?php else:?>
						<td><a href="editproduct.php?id=<?= $prod[$i]['id'] ?>&param=0">Удалить</a>
						</td>
						<?php endif;?>
						<td><input type="checkbox" name="delete[]" value="<?= $prod[$i]['id']?>"></td>
					</tr>
					<?php endfor;?>
				</table>
				<input name="del-butt" type="submit" value="Удалить выбранные" class="del-but">
					</form>
			</div>
			<?php endif;?>
		</div>
	</main>
</body>