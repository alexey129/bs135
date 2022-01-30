<?php
require_once './model/adminModel.php';
require_once './view/adminView.php';

class adminController{
	public $model = null;
	public $view = null;

	function __construct(){
		$this->model = new adminModel();
		$this->view = new adminView();
	}

	function isAutentification(){
		global $dbconn;
		$sql = 'SELECT name, password, isauth FROM users';
		$result = pg_query($dbconn, $sql);
		while ($row = pg_fetch_row($result)) {
			if($row[2] == 'f'){
				return false;
			} else {
				return true;
			}
		}
		return false;
	}

	public function controller(){
		if($this->isAutentification() == false){
			header("Location: " . SITE_PATH . "error");
		};
		$args = [];
		$this->view->print($args);
	}
}
?>
