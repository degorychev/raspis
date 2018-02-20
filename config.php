<?php
$cfg = array(
	'db_host' 			=> 'fdb14.biz.nf', //Хост.
	'db_name'			=> '2293678_name', //Имя.
	'db_user' 			=> '2293678_name', //Имя юзера.
	'db_pass' 			=> '4q4w0e7r1t3y3u', //Пароль.
);
$maspar = "!1r2e3w4q!";
$mysqli = new mysqli($cfg['db_host'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name']);
if ($mysqli->connect_errno) {
	printf("Соединение не удалось");
exit();
}