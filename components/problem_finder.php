<?php
require("config.php");

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
	
	$start_week = date("Y-m-d", $last_monday);	
	
	$sunday = strtotime('+6 day', $last_monday);
	$final_week = date("Y-m-d", $sunday);
	
	?>
	
<div class="panel panel-info text-center">
    <div class="panel-heading">
        <h3 class="panel-title">Сейчас показана <b><?=$week_show?></b> неделя.</h3>
		<h2 class="panel-title">С <?php echo date("d.m.Y", $last_monday)?> по <?php echo date("d.m.Y", $sunday)?></h2>
    </div>
</div>

<ul class="pager">
    <li class="previous"><a href="?page=problem_finder&num=<?=$bias-1?>">&larr; Предыдущая</a></li>
	<li class="next"><a href="?page=problem_finder&num=<?=$bias+1?>">Следующая &rarr;</a></li>
</ul>

<?php
$problems = false;
if($rez = $mysqli->query("select * from timetable where ((date>='".$start_week."') and (date<='".$final_week."') and (teacher !='Неизвестно') and (cabinet != 'УК-2')) order by date desc")){
	if(($rez->num_rows)>0){
		$num_par = 0;
		while($result = $rez->fetch_assoc()){				
			$validation = ((validity1($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])) and 
			(validity2($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])) and 
			(validity3($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])) and 
			(validity4($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])));
            if (!$validation){
                echo get_problem_table($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet']);
				$problems = true;
            }
		}
		$rez->free();
    }
}else{
	echo '<div class="alert alert-danger">Ошибка запроса расписания</div>';
	$rez->free();
}

if(!$problems)
	echo '<div class="alert alert-success" role="alert">
			Похоже, что на этой неделе проблем нет :)
		</div>'
?>