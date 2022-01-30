<?php
require_once './model/blogitemModel.php';
require_once './view/blogitemView.php';

class blogitemController{
	public $model = null;
	public $view = null;

	function __construct() {
		$this->model = new blogitemModel();
		$this->view = new blogitemView();
	}

	public function controller(){
		preg_match('/\d+/', $_GET['route'], $num);
		$number = $num[0];

		$args = [];
		$post = $this->model->getPost($number);
		$args['post'] = $post;
		$this->view->print($args);
	}
}
?>