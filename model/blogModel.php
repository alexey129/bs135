<?php
class Post{
	public $id = '';
	public $name = '';
	public $content = '';
}

class blogModel{
	public $posts = [];
	public function model(){
		echo 'model';
	}
	public function __construct(){
	}
	public function getPosts(){
		global $dbconn;
		$sql = "SELECT id, name, content FROM posts";
		$result = pg_query($dbconn, $sql);
		while ($row = pg_fetch_row($result)) {
			$item = new Post();
			$item->id = $row[0];
			$item->name = $row[1];
			$item->content = $row[2];
			$this->posts[] = $item;
		}
		return $this->posts;
	}
}
?>
