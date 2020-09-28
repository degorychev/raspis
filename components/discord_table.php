<?php
require("config.php");
//$next1 = isset($_GET['cab']);
//$next2 = isset($_GET['disc']);
$gruppa = "Discord";
//if ($next1)
//    $gruppa = htmlspecialchars($_GET['cab']);
//else 
//    $gruppa = "Кабинет";
//if($groups = $mysqli->query( "SELECT auditorii_original.`ID` as 'id_cab', timetable.`cabinet` as 'name' FROM timetable LEFT JOIN auditorii_original ON timetable.`cabinet` = auditorii_original.`auditoria` WHERE (date>DATE_ADD(now(), INTERVAL -31 DAY)) AND timetable.`cabinet` != '0' GROUP BY timetable.`cabinet`, auditorii_original.`ID` ORDER BY timetable.`cabinet`")){

$day_calc =0;
if(isset($_GET['day'])){
    $day_calc = htmlspecialchars($_GET['day']);
    $newday = date("Y-m-d", strtotime($day_calc." DAY"));;
}else{
    $newday = date("Y-m-d");
}
?>
<div align="center" style="margin-bottom: 20px;">

<?php
echo '<div class = "alert"></div>';
include ('dayinfo.php');

echo '<ul class="pager">
	<li class="previous"><a href="?page=discord_table&day='.($day_calc-1).'">&larr; Предыдущий</a></li>
    <li class="next"><a href="?page=discord_table&day='.($day_calc+1).'">Следующий &rarr;</a></li>
</ul>';
echo get_discord_table($newday);
    
?>
