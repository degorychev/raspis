<?php
require("config.php");
$next1 = isset($_GET['grup']);
$next2 = isset($_GET['disc']);
if ($next1)
    $gruppa = htmlspecialchars($_GET['grup']);
else 
    $gruppa = "Группа";
if($groups = $mysqli->query( "SELECT groups_original.`ID` as 'id_grup', timetable.`class` as 'name' FROM timetable LEFT JOIN groups_original ON timetable.`class` = groups_original.`Naimenovanie`  WHERE (date>DATE_ADD(now(), INTERVAL -31 DAY)) GROUP BY timetable.`class` ORDER BY timetable.`class`")){
?>
<div align="center" style="margin-bottom: 20px;">
<div class="btn-group">
    <button style="width: 180px;" type="button" class="btn btn-lg btn-default dropdown-toggle" data-toggle="dropdown"><?php echo $gruppa; ?> <span class="caret"></span></button>
    <ul style="min-width: 100px; width: 180px; text-align: center;" class="dropdown-menu" role="menu">
        <?php while($result = $groups->fetch_assoc()){ echo '<li><a style="white-space: normal; word-wrap: break-word;" href="?page=journal&grup='.$result['name'].'">'.$result['name'].'</a></li>'; } ?>
    </ul>
</div>
<?php
}else
    echo'<div class="alert alert-danger">Ошибка запроса</div>';
if ($next1){
    if ($next2)
    $disc = htmlspecialchars($_GET['disc']);
else 
    $disc = "Дисциплина";
    if($groups = $mysqli->query("SELECT `discipline` as 'name' from timetable where (`class` = '$gruppa' and  date > '".date("Y-m-d", $start_grup)."') group by `discipline` ")){
?>
<div class="btn-group">
    <button  type="button" class="btn btn-lg btn-default dropdown-toggle" data-toggle="dropdown"><?php echo $disc; ?> <span class="caret"></span></button>
    <ul style="min-width: 100px; text-align: center;" class="dropdown-menu" role="menu">
        <?php while($result = $groups->fetch_assoc()){ echo '<li><a style="white-space: normal; word-wrap: break-word;" href="?page=journal&grup='.$gruppa.'&disc='.$result['name'].'">'.$result['name'].'</a></li>'; } ?>
    </ul>
</div>
</div>
<?php
    }else
        echo'<div class="alert alert-danger">Ошибка запроса</div>';
    if ($next2){
        echo get_journal_table($gruppa, $disc);
    }
}
?>