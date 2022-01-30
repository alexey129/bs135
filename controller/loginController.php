<?php
require_once './model/loginModel.php';
require_once './view/loginView.php';

class loginController{
	public $model = null;
	public $view = null;

	function __construct(){
		$this->model = new loginModel();
		$this->view = new loginView();
	}

	public function controller(){
		$isauth = $this->model->model();
		$args = [];
		$args['isauth'] = $isauth;
		$this->view->print($args);
	}
}
?>
