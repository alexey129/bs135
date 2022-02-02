<?php
require_once '../config.php';
require_once BS_SITE_PATH . '/function.php';

$_POST = json_decode(file_get_contents('php://input'), true);
$dbconn = mysqli_connect(HOST, USER, PASSWORD, DBNAME);

deleteCard($_POST['id1'],$_POST['id2']);
?>
