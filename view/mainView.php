<?php
require_once './template/template.php';

class mainView{
	public function print(){
		headerTemplate();
		mainTemplate();
		footerTemplate();
	}
}
?>
