<?php
require_once './view/mainView.php';

class mainController{
	//public $model = null;
	public $view = null;

	function __construct(){
		//$this->model = new loginModel();
		$this->view = new mainView();
	}
	public function controller(){
		$this->view->print();
	}
}
?>
