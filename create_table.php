<?php
require("config.php");

if($mysqli->query("CREATE TABLE `grups` (
  `id_grup` int(10) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `start` int(15) NOT NULL,
  `last-apdata` text COLLATE utf8_unicode_ci NOT NULL,
  `pin` int(5) NOT NULL DEFAULT '1111',
  `time-start-par` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"))
	echo "Таблица grups создана";
else
	echo "Ошибка созлания grups";
if($mysqli->query("CREATE TABLE `raspis` (
  `id` int(10) NOT NULL,
  `id_grup` int(10) NOT NULL,
  `para` int(1) NOT NULL,
  `den` int(1) NOT NULL,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `weeks` varchar(100) NOT NULL,
  `auditor` varchar(10) NOT NULL,
  `prepod` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;"))
	echo "Таблица raspis создана";
else
	echo "Ошибка созлания raspis";
$mysqli->close();
?>