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
		$result = mysqli_query($dbconn, "SELECT id, name, content FROM posts");
		while ($row = mysqli_fetch_array($result)) {
			$item = new Post();
			$item->id = $row["id"];
			$item->name = $row["name"];
			$item->content = $row["content"];
			$this->posts[] = $item;
		}
		return $this->posts;
	}
}
?>
