<?php
	require('app/database/db.php');
	$id_user = $_GET["id"];
	$param = $_GET["param"];
	if($param == 1){
		update('users', ['id' => $id_user], ['role' => 'employee']);
	}
	elseif($param == 0){
		update('users', ['id' => $id_user], ['role' => 'user']);
	}
	header('location: admin.php?users=Редактировать+привелегии');
?>