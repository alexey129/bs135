<?php
$_POST = json_decode(file_get_contents('php://input'), true);
$nameInput = $_POST['name'];
$dbconn = pg_connect("host=localhost
					  port=5432
					  dbname=bs135
					  user=postgres
					  password=password
					");

$sql = 'SELECT id, name FROM playlists';
$result = pg_query($dbconn, $sql);
$res = [];
while ($row = pg_fetch_row($result)) {
	$resItem = [];
	$resItem[] = $row[0];
	$resItem[] = $row[1];
    $res[] = $resItem;
};
echo json_encode($res);
?>
