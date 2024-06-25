<?php require('app/database/db.php');?>
<?php
	$id = $_GET["id"];
	$param = ['id' => $id];
	$t = selectOne('recipes', $param);
		
	$param = ['id_recipe' => $id];
	$img_temp = selectAll('img_recipe', $param);
	for($j = 0; $j < count($img_temp); $j++){
		$img[$img_temp[$j]['part']] = $img_temp[$j]['img'];
	}
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
	<link rel="stylesheet" href="assets/css/recipe-page.css">
	<title><?= $t['title'] ?></title>
</head>

<body>
	<?php require("app/include/header.php"); ?>
	<main>
		<div class="back"><a href="index.php"><img src="assets/img/back.svg"></a></div>
		<div class="container">
			<div class="recipes__item">
				<div class="recipes__item__img">
					<img src="<?= $t['img'] ?>" alt="">
				</div>
				<div class="recipes__item__info">
					<div class="info__title">
						<h2 class="title"><?= $t['title'] ?></h2>
						<p class="author">Автор: <?= $t['author'] ?></p>
					</div>
					<div class="info__characteristic">
						<div class="ingredients">
							<?php echo countProduct($t['id']). ' ингредиентов';?>
						</div>
						<div class="times"><?= $t['time'] ?></div>
						<div class="difficult">
							Сложность
							<div class="difficult__circle">
								<?php for($i = 0; $i < 5 - $t['difficult']; $i++):?>
								<div class="circle"></div>
								<?php endfor;?>
								<?php for($i = 0; $i < $t['difficult']; $i++):?>
								<div class="circle set"></div>
								<?php endfor;?>
							</div>
						</div>
					</div>
					<div class="info__tags">
						<?php 
							$tags = resipeTags($t['id']);
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
					<div class="flag-title"><?= $t['likes'] ?></div>
				</div>
			</div>

			<div class="recipes__text">
				<div class="recipes__text__info">
					<!-- <select class="portion" id="portion" onchange="regenCount(this)">
					<?php for($i = 1; $i < 11; $i++):?>
						<?php if($t['portions'] == $i): ?>
							<option value="<?= $i ?>" selected><?= $i ?></option>
						<?php else:?>
							<option value="<?= $i ?>"><?= $i ?></option>
							<?php endif;?>
					<?php endfor;?>
				</select> -->
					<p> <?=$t['portions']?> порций </p>
					<div class="recipes__text__info__product">
						<?php 
							$prod = rec_pod_list($t['id']);
							for($j = 0; $j < count($prod); $j++){
								echo '<p class="product">'.$prod[$j]['title'].'</p>';
								echo '<p class="count">'.$prod[$j]['count'].' '.$prod[$j]['unit'].'</p>';
							}
						?>
					</div>
				</div>
				<div class="recipes__text__steps">
					<?php $path = $t['text'];
							$data = file_get_contents(__DIR__.$path);
							// echo $data;
							$obj = json_decode($data, true);
							$cnt = $obj["Count"];
							// echo $cnt;
				?>
					<?php for($i = 0; $i < $cnt; $i++):?>
					<h3 class="step"><?= $i+1 ?> шаг</h3>
					<p class="step__text"><?= $obj["Steps"][$i] ?></p>
					<div class="step__img">
						<img src="<?= $img[$i+1] ?>" alt="">
					</div>
					<?php endfor;?>
				</div>
			</div>
		</div>
	</main>
	<script src="assets/js/regauth.js"></script>
</body>