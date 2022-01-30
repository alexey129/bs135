<?php
require_once '../config.php';
$nameInput = $_POST['name'];
$passwordInput = $_POST['password'];

$dbconn = pg_connect("host=" . HOST . "
					  port=" . PORT . "
					  dbname=" . DBNAME . "
					  user=" . USER . "
					  password=" . PASSWORD . "
					");
if(!$dbconn){
	die('Could not connect\n');
} else {
	echo ("Connected to local DB\n");
}
$sql = 'SELECT name, password FROM users';
$result = pg_query($dbconn, $sql);
if(!$result) die("ошибка\n");
$aaa = 0;
while ($row = pg_fetch_row($result)) {
	if($nameInput == $row[0] && $passwordInput == $row[1]){
		$sql2 = "UPDATE users SET isauth = true WHERE name = '" . $row[0] .
				"' AND password = '" . $row[1] . "'";
		pg_query($dbconn, $sql2);
		if(!$sql2) die("ошибка\n");
		//команда для перехода на другую веб страницу
		header("Location: " . SITE_PATH . "admin");
		$aaa = 1;
	}
}
if($aaa == 0){
	header("Location: " . SITE_PATH . "login?wrong=1");
}

?>
