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
<ul class="pager">
    <li class="previous"><a href="?day=<?=$day_calc-1?>">&larr; Предыдущий</a></li>
    <li class="next"><a href="?day=<?=$day_calc+1?>">Следующий &rarr;</a></li>
</ul>

<div class="row"><!--Основной вывод расписания-->
    <div class="col-xs-12 col-md-4 col-md-offset-4">
        <div style="background: " class="panel panel-default">
<?php
echo get_table($name_group, $newday);
?>

        </div>
	</div>
</div><!--Основной вывод расписания-->