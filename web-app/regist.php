<?php 
	require('app/database/db.php');
	require('app/controllers/registration.php');
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
		<div class="registration">
			<div class="registration__form">
				<h2 style="text-align: center;">Регистрация</h2>
				<form action="regist.php" method="post">
					<label for="firstname">Имя</label><br>
					<input name="firstname" type="text" id="firstname" required placeholder="Иван"
						value="<?= $_POST['firstname'] ?? ''?>"> <br>

					<label for="lastname">Фамилия</label><br>
					<input name="lastname" type="text" id="lastname" required placeholder="Иванов"
						value="<?= $_POST['lastname'] ?? ''?>"> <br>

					<label for="email">Электронная почта</label><br>
					<input name="email" type="email" id="email" required placeholder="ivanov.ivan@mail.ru"
						value="<?= $_POST['email'] ?? ''?>"> <br>

					<label for="password1">Пароль</label> <br>
					<input name="passfirst" type="password" id="password1" required> <br>

					<label for="password2">Повторите пароль</label> <br>
					<input name="passsecond" type="password" id="password2" required> <br>
					<div class="err">
						<p><?= $errMsg ?></p>
					</div>
					<input name="but-reg" type="submit" value="Зарегестрироваться" class="buttreg">
				</form>
			</div>
		</div>
	</main>
</body>