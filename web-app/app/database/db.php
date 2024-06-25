<?php 
define('BASE_URL', 'http://recipes:8888/');
session_start();

require('connect.php');

function checkError($query){
	$errInfo = $query->errorInfo();
	if($errInfo[0] !== PDO::ERR_NONE){
		echo $errInfo[2];
		exit();
	}
}

function selectAll($table, $params = []){
	global $pdo;
	$sql = "SELECT * FROM $table";

	if(!empty($params)){
		$i = 0;
		foreach($params as $key => $value){
			if(!is_numeric($value)){
				$value = "'".$value."'";
			}
			if($i === 0){
				$sql = $sql . " WHERE $key = $value";
			}
			else{
				$sql = $sql . " AND $key = $value";
			}
			$i++;
		}
	}

	$query = $pdo->prepare($sql);
	$query->execute();

	checkError($query);

	return $query->fetchAll();
}

function selectOne($table, $params = []){
	global $pdo;
	$sql = "SELECT * FROM $table";

	if(!empty($params)){
		$i = 0;
		foreach($params as $key => $value){
			if(!is_numeric($value)){
				$value = "'".$value."'";
			}
			if($i === 0){
				$sql = $sql . " WHERE $key = $value";
			}
			else{
				$sql = $sql . " AND $key = $value";
			}
			$i++;
		}
	}

	$query = $pdo->prepare($sql);
	$query->execute();

	checkError($query);

	return $query->fetch();
}

function selectRecipe($tag, $product){
	global $pdo;
	if($tag != 0 && $product == 0) 
		$sql = "CALL po_tag('$tag');";
	elseif ($tag == 0 && $product != 0)
		$sql = "CALL po_prodict('$product');";
	elseif ($tag != 0 && $product != 0)
		$sql = "CALL tag_and_product('$tag', '$product');";
	else
		$sql = "SELECT * FROM recipes WHERE validly = 1";
	$query = $pdo->prepare($sql);
	$query->execute();

	checkError($query);

	return $query->fetchAll();
}

function countProduct($id){
	global $mysqli;
	$sql = "SELECT cnt_product('$id') as 'cnt'";
	return $mysqli->query($sql)->fetch_object()->cnt;
}

function resipeTags($id){
	global $pdo;
	$sql = "CALL resipe_tags('$id')";
	$query = $pdo->prepare($sql);
	$query->execute();

	checkError($query);

	return $query->fetchAll();
}

function prodUser($id){
	global $pdo;
	$sql = "CALL prod_user('$id')";
	$query = $pdo->prepare($sql);
	$query->execute();

	checkError($query);
	return $query->fetchAll();
}

function insert($table, $param){
	global $pdo;
	$i =0; $colom = ''; $val = '';
	foreach($param as $key => $value){
		if ($i === 0){
			$colom = $colom . "$key";
			$val = $val . "'$value'";
		}
		else{
			$colom = $colom . ", $key";
			$val = $val . ", '$value'";
		}
		$i++;
	}
	$sql = "INSERT INTO $table ($colom) VALUES ($val)";
	$query = $pdo->prepare($sql);
	$query->execute();
	checkError($query);

	return $pdo->lastInsertId();
}

function update($table, $where, $param){
	global $pdo;

	$i = 0; $str = '';
	foreach($param as $key => $value){
		if ($i === 0){
			$str = $str . $key . " = '$value'";
		}
		else{
			$str = $str . ", " . $key . " = '$value'";
		}
		$i++;
	}
	$i = 0; $par = '';
	foreach($where as $key => $value){
		if ($i === 0){
			$par = $par . $key . " = '$value'";
		}
		else{
			$par = $par . " AND " . $key . " = '$value'";
		}
		$i++;
	}
	$sql = "UPDATE $table SET $str WHERE $par";
	$query = $pdo->prepare($sql);
	$query->execute();
	checkError($query);
}

function delete($table, $param){
	global $pdo;
	$i = 0; $str = '';
	foreach($param as $key => $value){
		if ($i === 0){
			$str = $str . $key . " = '$value'";
		}
		else{
			$str = $str . " AND " . $key . " = '$value'";
		}
		$i++;
	}
	$sql = "DELETE FROM $table WHERE $str";
	$query = $pdo->prepare($sql);
	$query->execute();
	checkError($query);
}

function selectLastId($table){
	global $pdo;
	$sql = "SELECT MAX(id) as 'mx' FROM $table";
	$query = $pdo->prepare($sql);
	$query->execute();

	checkError($query);
	return $query->fetch();
}

function view($viewName){
	global $pdo;
	$sql = "SELECT * FROM $viewName";
	$query = $pdo->prepare($sql);
	$query->execute();

	checkError($query);
	return $query->fetchAll();
}

function rec_pod_list($id){
	global $pdo;
	$sql = "CALL rec_pod_list('$id')";
	$query = $pdo->prepare($sql);
	$query->execute();

	checkError($query);

	return $query->fetchAll();
}

?>