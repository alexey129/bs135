<?php
require_once './config.php';

$dbconn = mysqli_connect(HOST, USER, PASSWORD, DBNAME);

$IsAuthentification = "";
$result = mysqli_query($dbconn, "SELECT name, isauth FROM users");
while ($row = mysqli_fetch_array($result)) {
	if($row["isauth"] == "1"){
		$IsAuthentification = $row["name"];
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
