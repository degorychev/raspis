<?php
require("config.php");
$den = htmlspecialchars($_GET['date']);
$time = htmlspecialchars($_GET['time']);
$prepod = htmlspecialchars($_GET['teacher']);
$cabinet = htmlspecialchars($_GET['cabinet']);

if (!validity1(htmlspecialchars($den), htmlspecialchars($time), htmlspecialchars($prepod), htmlspecialchars($cabinet))){
    echo "Преподаватель обнаружен в двух кабинетах одновременно!";
    $rez = $mysqli->query("SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`teacher`='$prepod'))");

    echo '<table border="1">';
	echo '<thead>';
	echo '<tr>';
	echo '<th>дата</th>';
	echo '<th>время</th>';
	echo '<th>группа</th>';
	echo '<th>дисциплина</th>';
	echo '<th>тип</th>';
	echo '<th>преподаватель</th>';
	echo '<th>кабинет</th>';
	echo '<th>файл</th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	
	while($data = mysqli_fetch_array($rez)){ 
		echo '<tr>';
		echo '<td>' . $data['date'] . '</td>';
		echo '<td>' . $data['timeStart'] . '</td>';
		echo '<td>' . $data['class'] . '</td>';
		echo '<td>' . $data['discipline'] . '</td>';
		echo '<td>' . $data['type'] . '</td>';
		echo '<td>' . $data['teacher'] . '</td>';
		echo '<td>' . $data['cabinet'] . '</td>';
		echo '<td>' . $data['file'] . '</td>';
		echo '</tr>';
	}
	
    echo '</tbody>';
	echo '</table>';

}
if (!validity2(htmlspecialchars($den), htmlspecialchars($time), htmlspecialchars($prepod), htmlspecialchars($cabinet))){
    echo "В одном кабинете обнаружено два преподавателя одновременно!";
   
    $rez = $mysqli->query("SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`cabinet`='$cabinet'))");

    echo '<table border="1">';
	echo '<thead>';
	echo '<tr>';
	echo '<th>дата</th>';
	echo '<th>время</th>';
	echo '<th>группа</th>';
	echo '<th>дисциплина</th>';
	echo '<th>тип</th>';
	echo '<th>преподаватель</th>';
	echo '<th>кабинет</th>';
	echo '<th>файл</th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	
	while($data = mysqli_fetch_array($rez)){ 
		echo '<tr>';
		echo '<td>' . $data['date'] . '</td>';
		echo '<td>' . $data['timeStart'] . '</td>';
		echo '<td>' . $data['class'] . '</td>';
		echo '<td>' . $data['discipline'] . '</td>';
		echo '<td>' . $data['type'] . '</td>';
		echo '<td>' . $data['teacher'] . '</td>';
		echo '<td>' . $data['cabinet'] . '</td>';
		echo '<td>' . $data['file'] . '</td>';
		echo '</tr>';
	}
	
    echo '</tbody>';
	echo '</table>';

}
?>