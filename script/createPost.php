<?php
$_POST = json_decode(file_get_contents('php://input'), true);
$nameInput = $_POST['name'];
$contentInput = $_POST['content'];
echo $nameInput . ' - ' . $contentInput;
$dbconn = pg_connect("host=localhost
					  port=5432
					  dbname=bs135
					  user=postgres
					  password=password
					");

$sql = "INSERT INTO posts(name,content)
    VALUES('" . $nameInput . "','" . $contentInput . "')";
pg_query($dbconn, $sql);
?>