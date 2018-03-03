<?php
    $week_new = (int)((date('z',(strtotime('+'.$day_calc.' day')+60*60*3)) - date('z',$start_grup))/7)+1;
    $strday = date("d.m",(strtotime('+'.$day_calc.' day')+60*60*3))
?>
<div class="alert alert-info">
    <div class="row text-center">
        <div class="col-md-4 col-xs-12"><h3 class="panel-title">Сейчас показана <b><?=$week_new?></b> неделя,</h3></div>
        <div class="col-md-4 col-xs-6"><h3 class="panel-title"><b><?=day_of_week(date("N", strtotime($newday)))?></b></h3></div>
        <div class="col-md-3 col-xs-6"><h3 class="panel-title">Число: <b><?=$strday?></b></h3></div>
    </div>
</div>