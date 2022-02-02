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
		$result = query("SELECT id, name, content FROM posts");
		while ($row = fetch($result)) {
			if($row["id"] == $id){
				$item = new Post();
				$item->name = $row["name"];
				$item->content = $row["content"];
				return $item;
			}
		}
		return 0;
	}
}
?>
