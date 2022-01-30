<?php
$_POST = json_decode(file_get_contents('php://input'), true);
$nameInput = $_POST['name'];
$dbconn = pg_connect("host=localhost
					  port=5432
					  dbname=bs135
					  user=postgres
					  password=password
					");

$sql = "SELECT name, content, id FROM cards WHERE name='" . $nameInput . "'";
$result = pg_query($dbconn, $sql);
$res = [];
while ($row = pg_fetch_row($result)) {
	$res[] = $row[0];
	$res[] = $row[1];
	$res[] = $row[2];
};
echo json_encode($res);
?>
