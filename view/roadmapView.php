<?php
require_once './template/template.php';

class roadmapView{
	public function print($args){
		headerTemplate();
		roadmapTemplate($args);
		footerTemplate();
	}
}
?>
