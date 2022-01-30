<?php
$_POST = json_decode(file_get_contents('php://input'), true);
$nameInput = $_POST['name'];
$dbconn = pg_connect("host=localhost
					  port=5432
					  dbname=bs135
					  user=postgres
					  password=password
					");
$sql = "DELETE FROM posts WHERE name='" . $nameInput . "'";
pg_query($dbconn, $sql);
?>
