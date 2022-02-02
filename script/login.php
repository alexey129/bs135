<?php
require_once '../config.php';
require_once BS_SITE_PATH . '/function.php';
$dbconn = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
login($_POST['name'], $_POST['password']);
?>
