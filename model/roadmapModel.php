<?php
class roadmapModel{
	//получает данные плейлиста, указанного в GET параметрах
	public function getPlaylist(){
		global $dbconn;
		$playlist = $_GET["playlist"];
		$result = mysqli_query($dbconn,"SELECT id, name, cards FROM playlists");
		while ($row = mysqli_fetch_array($result)) {
			if($row["id"] == $playlist){
				return ["id"    => $row["id"],
						"name"  => $row["name"],
						"cards" => $row["cards"],
					   ];
			}
		}
		return 0;
	}

	//возвращает массив с карточками указанными в $cardsList
	public function getCards($cardsList){
		global $dbconn;
		$list = explode(",", $cardsList);
		$result = mysqli_query($dbconn,"SELECT id, name, content FROM cards");
		$resCards = [];
		while($row = mysqli_fetch_array($result)){
			foreach($list as &$value){
				if($row["id"] == $value){
					$resCards[] = ["id"    => $row["id"],
								   "name"  => $row["name"],
								   "content" => $row["content"],
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
