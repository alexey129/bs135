<?php
$_POST = json_decode(file_get_contents('php://input'), true);
$idInput = $_POST['id'];
$dbconn = pg_connect("host=localhost
					  port=5432
					  dbname=bs135
					  user=postgres
					  password=password
					");

$sql = 'SELECT id, name, cards FROM playlists';
$result = pg_query($dbconn, $sql);
$res = [];
$cardList = null;
while ($row = pg_fetch_row($result)) {
	if($row[0] == $idInput){
		$cardList = $row[2];
	}
};
//var_dump($cardList);
//получаем массив с id'ами карточек
$cardList = explode(',', $cardList);

foreach($cardList as &$value){
	$sql = 'SELECT id, name FROM cards';
	$result = pg_query($dbconn, $sql);
	while ($row = pg_fetch_row($result)) {
		if($row[0] == $value){
			$aaa = ["id" => $value, "name" => $row[1]];
			$res[] = $aaa;
		}
	};
}
echo json_encode($res);
?>
