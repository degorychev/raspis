<?php
$name_grup = get_groupname(15);
?>


<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Расписание <?=$name_grup?></a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li><a href="/?p">Выбрать группу</a></li>
            <li><a href="/?page=all-par">На всю неделю</a></li>
        </ul>
    </div><!--/.nav-collapse -->					
</div><!--Строка меню-->