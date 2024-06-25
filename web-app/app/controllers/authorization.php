<?php
	$errMsg = '';
	if(isset($_POST['but-login'])){
		$email = trim($_POST['email']);
		$pass = $_POST['pass'];

		$exisit = selectOne('users', ['email' => $email]);
		if($exisit['email'] === $email){
			if($exisit['password'] === $pass){
				$_SESSION['id'] = $exisit['id'];
				$_SESSION['name'] = $exisit['first_name'];
				$_SESSION['last_name'] = $exisit['last_name'];
				$_SESSION['email'] = $exisit['email'];
				$_SESSION['role'] = $exisit['role'];
				header('location: index.php');
			}
			else{
				$errMsg = "Неверный пароль";
			}
		}
		else{
			$errMsg = "Пользователя с такой почтой не существует";
		}
	}
?>