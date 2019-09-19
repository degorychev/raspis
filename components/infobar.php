<?php
    $week = (int)((date('z',(time()+60*60*3)) - date('z',$start_grup))/7)+1;
    $today = day_of_week(date('w',(time()+60*60*3)));
    $totime = date('G:i:s',(time()));
?>

<div class="alert alert-info">
    <div class="row text-center">
        <div class="col-md-4 col-xs-12"><h3 class="panel-title">Сегодня: <b><?=$today?></b></h3></div>
        <div class="col-md-4 col-xs-6"><h3 class="panel-title">Идет <b><?=$week?></b> неделя.</h3></div>
        <div class="col-md-3 col-xs-6"><h3 class="panel-title">Время: <b id="clock"><?=$totime?></b></h3></div>
    </div>
</div>

<?php 
/*
if(get_last_update() < get_TimeOnSite()) 
echo '<div class="alert alert-danger">
	Внимание, информация может быть не актуальной! На сайте ИАТУ есть запись от: <b>'.date('d.m.Y  H:i', get_TimeOnSite()).'</b>, это позже, чем время последнего обновления: <b>'.date('d.m.Y  H:i', get_last_update()).'</b>
</div>';
else
	echo '<div class="alert alert-success" role="alert">
			На сайте ИАТУ последняя запись от: <b>'.date('d.m.Y  H:i', get_TimeOnSite()).'</b>, это раньше, чем время последнего обновления: <b>'.date('d.m.Y  H:i', get_last_update()).'</b>, информация актуальна.
		</div>';
*/
?>
