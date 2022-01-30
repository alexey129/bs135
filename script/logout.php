<?php
require_once '../config.php';
$dbconn = pg_connect("host=localhost
					  port=5432
					  dbname=bs135
					  user=postgres
					  password=password
					");
if(!$dbconn){
	die('Could not connect\n');
} else {
	echo ("Connected to local DB\n");
}
$sql = 'SELECT name, password, isauth FROM users';
$result = pg_query($dbconn, $sql);
while ($row = pg_fetch_row($result)) {
	if($row[2] == true){
		$sql2 = "UPDATE users SET isauth = false WHERE name = '" . $row[0] . "' AND password = '" . $row[1] . "'";
		$res1 = pg_query($dbconn, $sql2);
		if(!$res1) die("ошибка\n");
		header("Location: " . SITE_PATH . "login");
	}
}

?>
