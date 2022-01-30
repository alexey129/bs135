<?php
require_once './config.php';
$dbconn = pg_connect("host=localhost
					  port=5432
					  dbname=bs135
					  user=postgres
					  password=password
					");

$IsAuthentification = "";
$sql = 'SELECT name, isauth FROM users';
$result = pg_query($dbconn, $sql);
$IsAuthentification = "";
while ($row = pg_fetch_row($result)) {
	if($row[1] == 't'){
		$IsAuthentification = $row[0];
	}
}

require_once './router.php';

$controllerName = router();

if($controllerName == 'error') echo 'страница не найдена';
else{
	$controllerName = $controllerName . 'Controller';

	$controllerPath = './controller/' . $controllerName . '.php';

	require_once $controllerPath;
	$contr = new $controllerName;
	$contr->controller();
}
?>
