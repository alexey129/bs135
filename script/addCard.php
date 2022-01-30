<?php
$_POST = json_decode(file_get_contents('php://input'), true);
$nameInput = $_POST['name'];
$playlistIdInput = $_POST['playlistId'];
$dbconn = pg_connect("host=localhost
					  port=5432
					  dbname=bs135
					  user=postgres
					  password=password
					");
//добавляем карточку в список карточек
$sql = "INSERT INTO cards(name,content)
    VALUES('" . $nameInput . "','')";
pg_query($dbconn, $sql);

//узнаем какой id назначен добавленной карточке
$sql = "SELECT id FROM cards WHERE name='". $nameInput ."'";
$result = pg_query($dbconn, $sql);
$tempIdCard = null;
while($row = pg_fetch_row($result)){
    $tempIdCard = $row[0];
}

//получаем список карточек плейлиста
$sql = "SELECT cards FROM playlists WHERE id='". $playlistIdInput ."'";
$result = pg_query($dbconn, $sql);
$tempIdList = null;
while($row = pg_fetch_row($result)){
    $tempIdList = $row[0];
}

$tempIdList = $tempIdList . "," . $tempIdCard;

$sql = "UPDATE playlists SET cards='" . $tempIdList . "' WHERE id='". $playlistIdInput ."'";
pg_query($dbconn, $sql);

?>
