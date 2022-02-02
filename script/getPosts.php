<?php
require_once '../config.php';
require_once BS_SITE_PATH . '/function.php';

$_POST = json_decode(file_get_contents('php://input'), true);
$dbconn = mysqli_connect(HOST, USER, PASSWORD, DBNAME);

$posts = getPosts();

echo json_encode($posts);
?>
