<?php
	require('app/database/db.php');
	$id = mt_rand(1, selectLastId('recipes')['mx']);
	$dailyRecipe = selectOne('recipes', ['id' => $id]);
	$to = selectOne('users', ['id' => $_SESSION['id']])['email']; //Кому
  $from = "seartch@recipe.ru"; //От кого
  $subject = "Рецепт дня!"; //Тема

	$path = $dailyRecipe['text'];
	$data = file_get_contents(__DIR__.$path);
	$obj = json_decode($data, true);
	$cnt = $obj["Count"];

	$steps = '<div>';
	for($i = 0; $i < $cnt; $i++){
		$steps = $steps. '<h2 style="font-size: 20px; font-style: bold;">Шаг '.($i+1).'</h2> <br>';
		$steps = $steps. '<p style="font-size: 16px;">'.$obj["Steps"][$i].'</p> <br>';
	}
	$steps = $steps. '</div>';
	$message = '
      <div style="text-align: center;">Уважаемый '.$_SESSION['name'].'!</div>
			<div">Рецепт дня сегодня – '.$dailyRecipe['title'].'!</div>
        '.$steps.'
    ';
	$headers = "Content-type: text/html; charset='utf-8 \r\n";
		if (mail($to, $subject, $message, $headers))
    {    
			echo $message;
			echo "сообщение успешно отправлено";
    } 
    else {
      echo "При отправке сообщения возникли ошибки";
    }
?>