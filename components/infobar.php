<?php
    $start_grup = 1517792461;
    $week = (int)((date('z',(time()+60*60*3)) - date('z',$start_grup))/7)+1;
    $today = day_of_week(date('w',(time()+60*60*3)));
    $totime = date('G:i:s',(time()+60*60*3));
?>

<div class="alert alert-info">
    <div class="row text-center">
        <div class="col-md-4 col-xs-12"><h3 class="panel-title">Сегодня: <b><?=$today?></b></h3></div>
        <div class="col-md-4 col-xs-6"><h3 class="panel-title">Идет <b><?=$week?></b> неделя.</h3></div>
        <div class="col-md-3 col-xs-6"><h3 class="panel-title">Время: <b id="clock"><?=$totime?></b></h3></div>
    </div>
</div>