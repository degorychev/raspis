<?php
require("config.php");
list($grupa, $kurs) = explode('-', $_GET['group']);
$god = 2021-(int)($kurs{0});

echo '<div class="alert alert-danger">
	Внимание, функционал в разработке. Адекватное отображение посещаемости работает только с парами позже 22.09.2020. Студенты, которые не выбрали себе группу в Discord - здесь отображены не будут!
</div>';
$prepod =  explode(" ", $_GET["teacher"]);
echo get_discord_journal_table($_GET["date"], $_GET["timeStart"], $_GET["timeStop"],$grupa,$god, $prepod[0]);
?>