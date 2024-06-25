<?php
	$errMsg = '';
	if(isset($_POST['but-reg'])){
		$firstname = trim($_POST['firstname']);
		$lastname = trim($_POST['lastname']);
		$email = trim($_POST['email']);
		$passfir = $_POST['passfirst'];
		$passsec = $_POST['passsecond'];
		$role = 'user';
		
		if($passfir !== $passsec){
			$errMsg = "Пароли не совпадают";
		}else{
			$exisit = selectOne('users', ['email' => $email]);
			if($exisit['email'] === $email){
				$errMsg = "Пользователь с такой почтой уже существует";
			}
			else{
				$post = [
					'password' => $passfir,
					'role' => $role, 
					'first_name' => $firstname,
					'last_name' => $lastname, 
					'email' => $email
				];
				$id = insert('users', $post);
				$user = selectOne('users', ['id' => $id]);

				$_SESSION['id'] = $user['id'];
				$_SESSION['name'] = $user['first_name'];
				$_SESSION['role'] = $user['role'];
				$_SESSION['email'] = $user['email'];
				$_SESSION['last_name'] = $exisit['last_name'];

				header('location: index.php');
		}
		}
	}
?>