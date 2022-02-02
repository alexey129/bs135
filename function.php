<?php
function addPlaylist($name){
    global $dbconn;
    $sql = "INSERT INTO playlists(name,cards) VALUES('" . $name . "','')";
    mysqli_query($dbconn, $sql);
}

function deletePlaylist($playlistId){
    global $dbconn;
    $sql = "SELECT cards FROM playlists WHERE id='". $playlistId ."'";
    $result = mysqli_query($dbconn, $sql);
    $tempIdList = null;
    while($row = mysqli_fetch_array($result)){
        $tempIdList = $row[0];
    }

    $arr1 = explode(",",$tempIdList);

    foreach($arr1 as $item){
    	$sql = "DELETE FROM cards WHERE id='". $item ."'";
    	mysqli_query($dbconn, $sql);
    }

    $sql = "DELETE FROM playlists WHERE id='". $playlistId ."'";
    mysqli_query($dbconn, $sql);
}

function getPlaylist(){
    global $dbconn;
    $sql = 'SELECT id, name FROM playlists';
    $result = mysqli_query($dbconn, $sql);
    $res = [];
    while ($row = mysqli_fetch_array($result)) {
    	$resItem = [];
    	$resItem[] = $row[0];
    	$resItem[] = $row[1];
        $res[] = $resItem;
    };
    return $res;
}

function getCardlist($id){
    global $dbconn;
    $sql = 'SELECT id, name, cards FROM playlists';
    $result = mysqli_query($dbconn, $sql);
    $res = [];
    $cardList = null;
    while ($row = mysqli_fetch_array($result)) {
    	if($row[0] == $id){
    		$cardList = $row[2];
    	}
    };
    //var_dump($cardList);
    //получаем массив с id'ами карточек
    $cardList = explode(',', $cardList);

    foreach($cardList as &$value){
    	$sql = 'SELECT id, name FROM cards';
    	$result = mysqli_query($dbconn, $sql);
    	while ($row = mysqli_fetch_array($result)) {
    		if($row[0] == $value){
    			$aaa = ["id" => $value, "name" => $row[1]];
    			$res[] = $aaa;
    		}
    	};
    }
    return $res;
}

function addCard($name, $playlistId){
    global $dbconn;
    $sql = "INSERT INTO cards(name,content)
        VALUES('" . $name . "','')";
    mysqli_query($dbconn, $sql);

    //узнаем какой id назначен добавленной карточке
    $sql = "SELECT id FROM cards WHERE name='". $name ."'";
    $result = mysqli_query($dbconn, $sql);
    $tempIdCard = null;
    while($row = mysqli_fetch_array($result)){
        $tempIdCard = $row["id"];
    }

    //получаем список карточек плейлиста
    $sql = "SELECT cards FROM playlists WHERE id='". $playlistId ."'";
    $result = mysqli_query($dbconn, $sql);
    $tempIdList = null;
    while($row = mysqli_fetch_array($result)){
        $tempIdList = $row["cards"];
    }

    $tempIdList = $tempIdList . "," . $tempIdCard;

    $sql = "UPDATE playlists SET cards='" . $tempIdList . "' WHERE id='". $playlistId ."'";
    mysqli_query($dbconn, $sql);
}

function deleteCard($cardId, $playlistId){
    global $dbconn;
    $sql = "DELETE FROM cards WHERE id='". $cardId ."'";
    mysqli_query($dbconn, $sql);

    $sql = "SELECT cards FROM playlists WHERE id='". $playlistId ."'";
    $result = mysqli_query($dbconn, $sql);
    $tempIdList = null;
    while($row = mysqli_fetch_array($result)){
        $tempIdList = $row[0];
    }
    echo $tempIdList;
    $tempIdList = str_replace($cardId, "", $tempIdList);
    $tempIdList = str_replace(",,", ",", $tempIdList);
    echo $tempIdList;

    $sql = "UPDATE playlists SET cards='" . $tempIdList . "' WHERE id='". $playlistId ."'";
    mysqli_query($dbconn, $sql);
}

function getCard($name){
    global $dbconn;
    $sql = "SELECT name, content, id FROM cards WHERE name='" . $name . "'";
    $result = mysqli_query($dbconn, $sql);
    $res = [];
    while ($row = mysqli_fetch_array($result)) {
    	$res[] = $row["name"];
    	$res[] = $row["content"];
    	$res[] = $row["id"];
    };
    return $res;
}

function saveCard($name, $content, $id){
    global $dbconn;
    $sql = "UPDATE cards SET name='" . $name . "', content='" . $content . "' WHERE id='" . $id . "'";
    $result = mysqli_query($dbconn, $sql);
}

function createPost($name, $content){
    global $dbconn;
    $sql = "INSERT INTO posts(name,content)
        VALUES('" . $name . "','" . $content . "')";
    mysqli_query($dbconn, $sql);
}

function deletePost($name){
    global $dbconn;
    $sql = "DELETE FROM posts WHERE name='" . $name . "'";
    mysqli_query($dbconn, $sql);
}

function savePost($name, $content){
    global $dbconn;
    $sql = "UPDATE posts SET content = '" . $content .
        "' WHERE name = '" . $name . "'";
    mysqli_query($dbconn, $sql);
}

function getPosts(){
    global $dbconn;
    $result = mysqli_query($dbconn, "SELECT name, content FROM posts");
    $posts = [];
    $count = 0;
    while($row = mysqli_fetch_array($result)){
    	$item = [
    		'name' => $row["name"],
    		'content' => $row["content"]
    	];
    	$posts['post' . $count] = $item;
    	$count++;
    }
    return $posts;
}

//возвращает строку зашифрованную шифром цезаря
function encryptionPassword($str){
    $alphabet = "bertluqipjmangyvwsfochkzxd";
	$res = "";
    for($i = 0; $i < strlen($str); $i++){
        $symbol = $str[$i];
        $position = strpos($alphabet, $symbol);
		if($position == strlen($alphabet) - 1){
			$position = 0;
		} else {
			$position++;
		}
        $res = $res . $alphabet[$position];
    }
	return $res;
}

function login($name, $password){
    $password = encryptionPassword($password);
    global $dbconn;
    $sql = 'SELECT name, password FROM users';
    $result = mysqli_query($dbconn, $sql);
    if(!$result) die("ошибка\n");
    $aaa = 0;
    while ($row = mysqli_fetch_array($result)) {
    	if($name == $row["name"] && $password == $row["password"]){
		$sql2 = "UPDATE users SET isauth = 1
        WHERE name = \"{$row["name"]}\" AND password = \"{$row["password"]}\"";
    		mysqli_query($dbconn, $sql2);
    		if(!$sql2) die("ошибка\n");
    		//команда для перехода на другую веб страницу
    		header("Location: " . BS_SITE_URL . "admin");
    		$aaa = 1;
    	}
    }
    if($aaa == 0){
    	header("Location: " . BS_SITE_URL . "login?wrong=1");
    }
}

function logout(){
    global $dbconn;
    $sql = 'SELECT name, password, isauth FROM users';
    $result = mysqli_query($dbconn, $sql);
    while ($row = mysqli_fetch_array($result)) {
    	if($row[2] == true){
    		$sql2 = "UPDATE users SET isauth = false WHERE name = '" . $row[0] . "' AND password = '" . $row[1] . "'";
    		$res1 = mysqli_query($dbconn, $sql2);
    		if(!$res1) die("ошибка\n");
    		header("Location: " . BS_SITE_URL . "login");
    	}
    }
}
?>
