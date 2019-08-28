<?php
require("config.php");
$next1 = isset($_GET['cab']);
//$next2 = isset($_GET['disc']);
if ($next1)
    $gruppa = htmlspecialchars($_GET['cab']);
else 
    $gruppa = "Кабинет";
if($groups = $mysqli->query( "SELECT auditorii_original.`ID` as 'id_cab', timetable.`cabinet` as 'name' FROM timetable LEFT JOIN auditorii_original ON timetable.`cabinet` = auditorii_original.`auditoria` WHERE (date>DATE_ADD(now(), INTERVAL -31 DAY)) AND timetable.`cabinet` != '0' GROUP BY timetable.`cabinet`, auditorii_original.`ID` ORDER BY timetable.`cabinet`")){

$day_calc =0;
if(isset($_GET['day'])){
    $day_calc = htmlspecialchars($_GET['day']);
    $newday = date("Y-m-d", strtotime($day_calc." DAY"));;
}else{
    $newday = date("Y-m-d");
}
?>
<div align="center" style="margin-bottom: 20px;">
<div class="btn-group">
    <button style="width: 180px;" type="button" class="btn btn-lg btn-default dropdown-toggle" data-toggle="dropdown"><?php echo $gruppa; ?> <span class="caret"></span></button>
    <ul style="min-width: 100px; width: 180px; text-align: center;" class="dropdown-menu" role="menu">
        <?php while($result = $groups->fetch_assoc()){ echo '<li><a style="white-space: normal; word-wrap: break-word;" href="?page=сabinet_schedule&cab='.$result['name'].'">'.$result['name'].'</a></li>'; } ?>
    </ul>
</div>
<?php
}else
    echo'<div class="alert alert-danger">Ошибка запроса</div>';
if ($next1){
	echo '<div class = "alert"></div>';
	include ('dayinfo.php');

	echo '<ul class="pager">
    <li class="previous"><a href="?page=сabinet_schedule&cab='.$_GET['cab'].'&day='.($day_calc-1).'">&larr; Предыдущий</a></li>
    <li class="next"><a href="?page=сabinet_schedule&cab='.$_GET['cab'].'&day='.($day_calc+1).'">Следующий &rarr;</a></li>
</ul>';
	echo get_cabinet_table($_GET['cab'], $newday);
}
    
?>
