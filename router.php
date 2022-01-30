<?php
function router(){
	$controllerName = 'error';

	if(!(empty($_GET['route']))){

		$url = $_GET['route'];

		if($url == 'blog'){
			$controllerName = 'blog';
		} else if($url == 'login'){
			$controllerName = 'login';
		} else if($url == 'admin'){
			$controllerName = 'admin';
		} else if (preg_match('/^blogitem-\d+$/', $url) != 0){
			$controllerName = 'blogitem';
		} else if($url == 'roadmap'){
			$controllerName = 'roadmap';
		}

	} else {
		/*тут я вместо main поставил error потому что страница "главная"
		еще не готова. и если добавлять то надо еще добавить ее в хидере*/
		$controllerName = 'error';
		//$controllerName = 'main';
	}
	return $controllerName;
}
?>
