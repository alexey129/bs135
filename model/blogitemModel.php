<?php
class Post{
	public $name = '';
	public $content = '';
}

class blogitemModel{
	public function model(){
		echo 'model';
	}

	public function __construct(){
	}

	public function getPost($id){
		global $dbconn;
		$sql = 'SELECT id, name, content FROM posts';
		$result = pg_query($dbconn, $sql);
		while ($row = pg_fetch_row($result)) {
			if($row[0] == $id){
				$item = new Post();
				$item->name = $row[1];
				$item->content = $row[2];
				return $item;
			}
		}
		return 0;
	}
}
?>
