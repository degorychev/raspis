<?php
$den = htmlspecialchars($_GET['date']);
$time = htmlspecialchars($_GET['time']);
$prepod = htmlspecialchars($_GET['teacher']);
$cabinet = htmlspecialchars($_GET['cabinet']);

echo get_problem_table($den, $time, $prepod, $cabinet);

?>