<?php
    $week_show=(int)((date('z') - date('z',$start_grup))/7)+1;
	if(date("w")=="1")
	{		
		$last_monday = strtotime("today");
		if(isset($_GET['num'])){
			$bias = htmlspecialchars($_GET['num']);
			$week_show += $bias;

			if ($bias==1)
				$last_monday = strtotime("Next Monday");
			elseif($bias!=0)
				$last_monday = strtotime($bias." Monday"); 
		}	
	}
	else
	{
		$last_monday = strtotime("last Monday");
		if(isset($_GET['num'])){
			$bias = htmlspecialchars($_GET['num']);
			$week_show += $bias;

			if ($bias==1)
				$last_monday = strtotime("Next Monday");
			elseif($bias<0){
				$temp_bias = $bias-1;
				$last_monday = strtotime($temp_bias." Monday");
			}
			elseif($bias!=0)
				$last_monday = strtotime($bias." Monday"); 
		}			
    }
?>

<div class="panel panel-info text-center">
    <div class="panel-heading">
        <h3 class="panel-title">Сейчас показана <b><?=$week_show?></b> неделя.</h3>
    </div>
</div>

<ul class="pager">
    <li class="previous"><a href="?page=all-par&num=<?=$bias-1?>">&larr; Предыдущая</a></li>
	<li class="next"><a href="?page=all-par&num=<?=$bias+1?>">Следующая &rarr;</a></li>
</ul>
<div class="row">

<?php
    for($num_day=0; $num_day<=5; $num_day++){
        $work_day = date_create(); 
        date_timestamp_set($work_day, $last_monday);
        date_modify($work_day, '+'.$num_day.' day');

        $normdata = strtotime(date_format($work_day, "Y-m-d"));

        if(date_format($work_day, "Y-m-d") == date('Y-m-d', (strtotime("now"))))//Если сегодня
            $co = 'style="background: #ffab60;"';
        else
            $co = '';
        
?>
    <div class="col-md-4 col-xs-12" >
        <div <?=$co?> class="panel panel-default"><!--Вывод расписания на всю неделю-->
            <div class="panel-heading">
                <h3 class="panel-title"><?=day_of_week(date("N", $normdata))." (".date('d ', $normdata).$monthes[(date('n', $normdata))],")" ?></h3>
			</div>
            <?php 
            if ($_COOKIE['pos'] == 1){
                echo get_table($name_group, date_format($work_day, "Y-m-d")); 
            }elseif($_COOKIE['pos'] == 2){
                echo get_table_teacher($name_group, date_format($work_day, "Y-m-d"));
            }
            
            ?>
        </div>
    </div>
    
<?php
        if($num_day == 2)
            echo'</div><div class="row">';
    }
?>

</div>