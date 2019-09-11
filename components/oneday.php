<?php
if(isset($_GET['day'])){
    $day_calc = htmlspecialchars($_GET['day']);
    $newday = date("Y-m-d", strtotime($day_calc." DAY"));
    if(htmlspecialchars($_GET['day']) != 0){
        include ('dayinfo.php');
    }
}else{
    $newday = date("Y-m-d");
}

?>
<ul class="row text-center pager">
    <div class="col-md-4 col-xs-4"> <li class="previous"><a href="?day=<?=$day_calc-1?>">&larr;Пред. день</a></li></div>
    <div class="col-md-4 col-xs-4"> <li><a href="?page=all-par">На всю неделю</a></li></div>
    <div class="col-md-4 col-xs-4"> <li class="next"><a href="?day=<?=$day_calc+1?>">След. день&rarr;</a></li></div>
</ul>

<div class="row"><!--Основной вывод расписания-->
    <div class="col-xs-12 col-md-4 col-md-offset-4">
        <div class="panel panel-default">
<?php
if ($_COOKIE['pos_ulstu'] == 1){
    echo get_table($name_group, $newday);
}elseif($_COOKIE['pos_ulstu'] == 2){
    echo get_table_teacher($name_group, $newday);
}
?>

        </div>
	</div>
</div><!--Основной вывод расписания-->
