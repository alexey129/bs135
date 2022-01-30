<?php
require_once './model/roadmapModel.php';
require_once './view/roadmapView.php';

class roadmapController{
	public $model = null;
	public $view = null;

	function __construct() {
		$this->model = new roadmapModel();
		$this->view = new roadmapView();
	}

	public function controller(){
		$playlist = $this->model->getPlaylist();
		$cardlist = $this->model->getCards($playlist["cards"]);
		$args = ["playlist" => $playlist,
				 "cardlist" => $cardlist,
				 "currentcard" => $_GET["card"]];
		$this->view->print($args);
	}
}
?>
