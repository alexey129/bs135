<?php
$_POST = json_decode(file_get_contents('php://input'), true);
$nameInput = $_POST['name'];
$contentInput = $_POST['content'];
$idInput = $_POST['id'];
$dbconn = pg_connect("host=localhost
					  port=5432
					  dbname=bs135
					  user=postgres
					  password=password
					");

$sql = "UPDATE cards SET name='" . $nameInput . "', content='" . $contentInput . "' WHERE id='" . $idInput . "'";
$result = pg_query($dbconn, $sql);
?>
