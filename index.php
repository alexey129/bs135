<?php
require_once './config.php';
$dbconn = pg_connect("host=ec2-3-227-15-75.compute-1.amazonaws.com
					  port=5432
					  dbname=da0mrntn88a3vi
					  user=fnhbktcfomqyqc
					  password=ef91e3b2d02efa2c0cc9f6c243462f03aa66e63965241c5f1b424d0efc54fa74
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
