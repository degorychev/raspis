<?php

//ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

$cfg = array(
	'db_host' 			=> '127.0.0.1', //Хост.
	'db_name'			=> 'raspisanie', //Имя.
	'db_user' 			=> 'root', //Имя юзера.
	//'db_pass' 			=> '4q4w0e7r1t3y3u', //Пароль.
);
$maspar = "!1r2e3w4q!";
$mysqli = new mysqli($cfg['db_host'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name']);
$mysqli->set_charset("utf8");
if ($mysqli->connect_errno) {
	printf("Соединение не удалось");
exit();
}