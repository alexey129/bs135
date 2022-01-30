<?php
class roadmapModel{
	//получает данные плейлиста, указанного в GET параметрах
	public function getPlaylist(){
		$playlist = $_GET["playlist"];
		global $dbconn;
		$sql = 'SELECT id, name, cards FROM playlists';
		$result = pg_query($dbconn, $sql);
		while ($row = pg_fetch_row($result)) {
			if($row[0] == $playlist){
				return ["id"    => $row[0],
						"name"  => $row[1],
						"cards" => $row[2],
					   ];
			}
		}
		return 0;
	}

	//возвращает массив с карточками указанными в $cardsList
	public function getCards($cardsList){
		$list = explode(",", $cardsList);
		global $dbconn;
		$sql = 'SELECT id, name, content FROM cards';
		$result = pg_query($dbconn, $sql);
		$resCards = [];
		while($row = pg_fetch_row($result)){
			foreach($list as &$value){
				if($row[0] == $value){
					$resCards[] = ["id"    => $row[0],
								   "name"  => $row[1],
								   "content" => $row[2],
						   		  ];
				}
			}
			unset($value);
		}
		return $resCards;
	}

	public function model(){
		echo 'model';
	}
}
?>
