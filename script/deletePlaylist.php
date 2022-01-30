<?php
$_POST = json_decode(file_get_contents('php://input'), true);
$idInput = $_POST['id'];
$dbconn = pg_connect("host=localhost
					  port=5432
					  dbname=bs135
					  user=postgres
					  password=password
					");

$sql = "SELECT cards FROM playlists WHERE id='". $idInput ."'";
$result = pg_query($dbconn, $sql);
$tempIdList = null;
while($row = pg_fetch_row($result)){
    $tempIdList = $row[0];
}

$arr1 = explode(",",$tempIdList);

foreach($arr1 as $item){
	$sql = "DELETE FROM cards WHERE id='". $item ."'";
	pg_query($dbconn, $sql);
}

$sql = "DELETE FROM playlists WHERE id='". $idInput ."'";
pg_query($dbconn, $sql);
?>
