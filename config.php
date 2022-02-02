<?php
define("BS_SITE_URL", "http://" . $_SERVER['SERVER_NAME'] . "/");
define("BS_SITE_PATH", $_SERVER['DOCUMENT_ROOT']);

//константы для базы данных

if($_SERVER['SERVER_NAME'] == "bs135"){
    //локально
    define("HOST", "localhost");
    define("DBNAME", "bs135");
    define("USER", "root");
    define("PASSWORD", "qwertyuiop[]");
} else {
    //на хостинге
    define("HOST", "localhost");
    define("DBNAME", "g90895yr_wp1");
    define("USER", "g90895yr_wp1");
    define("PASSWORD", "Rl17XH*G");
}
