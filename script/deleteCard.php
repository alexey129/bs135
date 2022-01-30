<?php
$_POST = json_decode(file_get_contents('php://input'), true);
$idInput = $_POST['id1'];
$idPInput = $_POST['id2'];
$dbconn = pg_connect("host=localhost
					  port=5432
					  dbname=bs135
					  user=postgres
					  password=password
					");

$sql = "DELETE FROM cards WHERE id='". $idInput ."'";
pg_query($dbconn, $sql);

$sql = "SELECT cards FROM playlists WHERE id='". $idPInput ."'";
$result = pg_query($dbconn, $sql);
$tempIdList = null;
while($row = pg_fetch_row($result)){
    $tempIdList = $row[0];
}
echo $tempIdList;
$tempIdList = str_replace($idInput, "", $tempIdList);
$tempIdList = str_replace(",,", ",", $tempIdList);
echo $tempIdList;

$sql = "UPDATE playlists SET cards='" . $tempIdList . "' WHERE id='". $idPInput ."'";
pg_query($dbconn, $sql);
?>
