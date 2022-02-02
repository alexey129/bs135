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
		$result = mysqli_query($dbconn, $sql);
		while ($row = mysqli_fetch_array($result)) {
			if($row["isauth"] == false){
				return false;
			} else {
				return true;
			}
		}
		return false;
	}

	public function controller(){
		if($this->isAutentification() == false){
			header("Location: " . BS_SITE_URL . "error");
		};
		$args = [];
		$this->view->print($args);
	}
}
?>
