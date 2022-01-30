<?php
require_once './model/blogModel.php';
require_once './view/blogView.php';

class blogController{
	public $model = null;
	public $view = null;

	function __construct() {
		$this->model = new blogModel();
		$this->view = new blogView();
	}

	public function controller(){
		$args = [];
		$posts = $this->model->getPosts();
		$args['posts'] = $posts;
		$this->view->print($args);
	}
}
?>