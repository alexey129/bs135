<?php 
require_once './template/template.php';

class adminView{
	public function print($args){
		headerTemplate();
		adminTemplate();
		footerTemplate();
	}
}
?>