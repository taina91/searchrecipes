<header>
	<nav>
		<img src="img/logo.png" alt="" class="logo">
		<ul class="menu">
			<a href="index.php" style="text-decoration: none;">
				<li class="menu__item">Рецепты</li>
			</a>
			<?php if(isset($_SESSION['id'])):?>
			<a href="fridge.php" style="text-decoration: none;">
				<li class="menu__item">Холодильник</li>
			</a>
			<a href="#" style="text-decoration: none;">
				<li class="menu__item">Избранные рецепты</li>
			</a>
			<a href="my_recipe.php" style="text-decoration: none;">
				<li class="menu__item">Мои рецепты</li>
			</a>
			<?php if($_SESSION['role'] == 'employee' || $_SESSION['role'] == 'admin'):?>
			<a href="admin.php" style="text-decoration: none;">
				<li class="menu__item">Админка</li>
			</a>
			<?php endif;?>
			<?php endif;?>
		</ul>
		<?php if(isset($_SESSION['id'])):?>
		<div class="profile">
			<a href="sendmail.php" style="text-decoration: none;">
				<div class="menu__button reg_button"><?= $_SESSION['name'] ?></div>
			</a>
			<a href="logout.php" style="text-decoration: none;">
				<div class="menu__button log_button">Выйти</div>
			</a>
		</div>
		<?php else: ?>
		<div class="profile">
			<a href="regist.php" style="text-decoration: none;">
				<div class="menu__button reg_button">Зарегестрироваться</div>
			</a>
			<a href="login.php" style="text-decoration: none;">
				<div class="menu__button log_button">Войти</div>
			</a>
		</div>
		<?php endif;?>
	</nav>
</header>