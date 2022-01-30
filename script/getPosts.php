<?php
$dbconn = pg_connect("host=localhost
					  port=5432
					  dbname=bs135
					  user=postgres
					  password=password
					");
$sql = "SELECT name, content FROM posts";
$result = pg_query($dbconn, $sql);
$posts = [];
$count = 0;
while($row = pg_fetch_row($result)){
	$item = [
		'name' => $row[0],
		'content' => $row[1]
	];
	$posts['post' . $count] = $item;
	$count++;
}
echo json_encode($posts);
?>
