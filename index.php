<?php

require("config.php");
require("code.php");
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Расписание</title>
    <link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
	<style>
		.btop{
			border-top: 2px solid #000000;
		}
		.bleft{
			border-left: 2px solid #000000;
		}
		.bright{
			border-right: 2px solid #000000;
		}
		.bbottom{
			border-bottom: 2px solid #000000;
		}
	</style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
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
            <li class="dropdown">
          		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Еще <b class="caret"></b></a>
          		<ul class="dropdown-menu">
            		<li><a href="/?page=add-grup">Добавить группу</a></li>
            		<li class="divider"></li>
            		<li><a href="/?page=allow-edit-par">Доступ к редактированию</a></li>
            		<?php
            		if(isset($pin) && ($_COOKIE['pin'.$id_grup] == $pin)){
            		echo '<li class="divider"></li>
            		<li><a href="/?page=add-par">Добавить пару</a></li>';
            		//<li class="disabled"><a href="/?page=edit-par">Редактировать пары</a></li>';
            		}
            		if($_SESSION['mast']){
            			echo '<li class="divider"></li>
            			<li><a href="/?page=add-par-bonch">Добавление пар Бонч</a></li>';
            		}?>
          		</ul>
        	</li>
        	</ul>
        	<ul class="nav navbar-nav navbar-right">
        	<li><a style="padding-top: 10px; padding-bottom: 10px" href="#"><!-- HotLog -->
<span id="hotlog_counter"></span>
<span id="hotlog_dyn"></span>
<script type="text/javascript"> var hot_s = document.createElement('script');
hot_s.type = 'text/javascript'; hot_s.async = true;
hot_s.src = 'http://js.hotlog.ru/dcounter/2546330.js';
hot_d = document.getElementById('hotlog_dyn');
hot_d.appendChild(hot_s);
</script>
<noscript>
<a href="http://click.hotlog.ru/?2546330" target="_blank">
<img src="http://hit2.hotlog.ru/cgi-bin/hotlog/count?s=2546330&im=351" height="50px" width="50" border="0" 
title="HotLog" alt="HotLog"></a>
</noscript>
<!-- /HotLog --></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      
    </div><!--Строка меню-->
    <div style="margin-top: 70px;" class="container">
	<?php
	if(isset($alert))
			echo $alert;
	if($_GET['page'] == 'add-grup'){
	?>
	<div class="page-header"><h3>Добавление группы</h3></div>
	<div class="panel panel-body">
			<form class="form-horizontal" role="form" name="add-grup" method="post" action="/?page=add-grup">
			  <div class="form-group">
			    <label for="inputName" class="col-sm-4 control-label">Название</label>
			    <div class="col-sm-8">
			      <input name="name-grup" type="text" class="form-control" id="inputName" placeholder="Название" required>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputData" class="col-sm-4 control-label">Дата начала семестра</label>
			    <div class="col-sm-8">
			      <input name="data-tart-grup" type="date" class="form-control" id="inputDta" placeholder="Дата начала семестра" required>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPin" class="col-sm-4 control-label">Пин код для доступа к редактированию</label>
			    <div class="col-sm-8">
			      <input name="pin-grup" type="text" class="form-control" id="inputPin" placeholder="Пин код для доступа к редактированию" required>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-4 col-sm-8">
			      <button type="submit" class="btn btn-default">Добавить</button>
			    </div>
			  </div>
			</form>
	</div>
	<?php
	}
	elseif($_GET['page'] == 'add-par-bonch'){
		if($_SESSION['mast']){
	?>
	<div class="page-header"><h3>Добавление расписания Бонч</h3></div>
	<div class="panel panel-body">
	<p>Зайди на эту страницу: <a href="https://cabinet.sut.ru/raspisanie_all_new">линк</a>, сохранить страницу как и загрузить сюда.</p>
		<form enctype="multipart/form-data" class="form-horizontal" role="form" name="add-par-bonch" method="post" action="/?page=add-par-bonch">
			<div class="form-group">
			    <label for="inputName" class="col-sm-4 control-label">Название</label>
			    <div class="col-sm-8">
			      <input name="name-grup" type="text" class="form-control" id="inputName" placeholder="Название" required>
			    </div>
			  </div>
			<div class="form-group">
			    <label for="inputFile" class="col-sm-4 control-label">Загрузить фаил расписания</label>
			    <div class="col-sm-8">
			    	<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
			    	<input name="file-grup" type="file" id="inputFile" required>
				</div>
			</div>
			<div class="form-group">
			    <label for="inputData" class="col-sm-4 control-label">Дата начала семестра</label>
			    <div class="col-sm-8">
			      <input name="data-tart-grup" type="date" class="form-control" id="inputDta" placeholder="Дата начала семестра" required>
			    </div>
			  </div>
			<div class="form-group">
			    <label for="inputPin" class="col-sm-4 control-label">Пин код для доступа к редактированию</label>
			    <div class="col-sm-8">
			    	<input name="pin-grup" type="text" class="form-control" id="inputPin" placeholder="Пин код для доступа к редактированию" required>
				</div>
			</div>
			<div class="form-group">
			    <div class="col-sm-offset-4 col-sm-8">
			    	<button type="submit" class="btn btn-default">Добавить</button>
			    </div>
			</div>
		</form>
	</div>
	<?php
	}
	}
	else{
    if((!isset($_COOKIE['id'])) or $vibr_grup) //Выбор группы
    {
    	if($rez = $mysqli->query( "SELECT * FROM grups")){
    ?>
    	<table width=100%">
			<tr><td valign="center">
		    	<div align="center">
					<div class="page-header"><h1>Привет</h1></div>
			        <p>Выбери свою группу.</p>
					<div class="btn-group">
						<button style="width: 150px;" type="button" class="btn btn-lg btn-default dropdown-toggle" data-toggle="dropdown">Выбери <span class="caret"></span></button>
						<ul style="min-width: 100px; width: 150px; text-align: center;" class="dropdown-menu" role="menu">
						<?php while($result = $rez->fetch_assoc()){ echo '<li><a style="white-space: normal; word-wrap: break-word;" href="/?id='.$result['id_grup'].'">'.$result['name'].'</a></li>'; } ?>
						</ul>
					</div>
				</div>
			</td></tr>
		</table>
	<?php
	$rez->free(); 
	}else
		echo'<div class="alert alert-danger">Ошибка запроса</div>';
	}
	else
	{
	?>
		<div class="alert alert-info">
			<div class="row text-center">
			<div class="col-md-4 col-xs-12"><h3 class="panel-title">Сегодня: <b><?=day($day_num)?></b></h3></div>
			<div class="col-md-4 col-xs-6"><h3 class="panel-title">Идет <b><?=$week?></b> неделя.</h3></div>
			<div class="col-md-3 col-xs-6"><h3 class="panel-title">Время: <b id="clock"><?=date('G:i:s',(time()+60*60*3))?></b></h3></div>
			</div>
		</div><!--Информация о дне, неделе, времени-->
		<?php
		if(!isset($error1)){
			if(isset($alert2))
			echo $alert2;
		if($_GET['page'] == 'add-par'){
			if(isset($pin) && ($_COOKIE['pin'.$id_grup] == $pin)){
		?>
		<div class="panel panel-body">
			<form role="form" name="add-para" method="post" action="/?page=add-par">
				<div class="form-group">
					<label for="inputDay">День недели</label>
					<select name="day-par" class="form-control" id="inputDay">
					  <option>1</option>
					  <option>2</option>
					  <option>3</option>
					  <option>4</option>
					  <option>5</option>
					  <option>6</option>
					  <option>0</option>
					</select>
				</div>
				<div class="form-group">
					<label for="inputNum">№ пары</label>
					<select name="num-par" class="form-control" id="inputNum">
					  <option>1</option>
					  <option>2</option>
					  <option>3</option>
					  <option>4</option>
					  <option>5</option>
					</select>
				</div>
				<div class="form-group">
					<label for="inputName">Название пары</label>
				    <input name="name-par" type="text" class="form-control" id="inputName" placeholder="Название пары" required>
				</div>
				<div class="form-group">
					<label for="inputType">Тип пары</label>
				    <select name="type-par" class="form-control" id="inputType">
					  <option>Лекция</option>
					  <option>Практические занятия</option>
					  <option>Лабораторная работа</option>
					  <option>Консультация</option>
					  <option>Экзамен</option>
					</select>
				</div>
				<div class="form-group">
					<label for="inputWeek">По каким неделям</label>
				    <input name="week-par" type="text" class="form-control" id="inputWeek" placeholder="По каким неделям" required>
				</div>
				<div class="form-group">
					<label for="inputPrepod">Преподаватель</label>
				    <input name="prepod-par" type="text" class="form-control" id="inputPrepod" placeholder="Преподаватель" required>
				</div>
				<div class="form-group">
					<label for="inputAyd">Аудитория</label>
				    <input name="aud-par" type="text" class="form-control" id="inputAyd" placeholder="Аудитория" required>
				</div>
				<button type="submit" class="btn btn-default">Добавить</button>
			</form>
		</div>
		<?php
		}
		} //------------------------------Добавление пары
		elseif($_GET['page'] == 'allow-edit-par'){ //------------------------------------------------------------
		?>
		<div class="panel panel-body">
			<form class="form-horizontal" role="form" name="add-pin" method="post" action="/?page=allow-edit-par">
				<div class="form-group">
					<label for="inputPin1">Пин код для доступа к редактированию группы <?=$name_grup?></label>
				    <input name="pingrup" type="text" class="form-control" id="inputPin1" placeholder="Пин" required>
				</div>
			  <div class="form-group">
			      <button type="submit" class="btn btn-default">Ввести</button>
			  </div>
			</form>
		</div>
		<?php		
		} //-------------------Разрешение на редактирование
		elseif($_GET['page'] == 'all-par'){
			if(isset($_GET['num']))
			$week_all = htmlspecialchars($_GET['num']);
			else
			$week_all = $week;
			?>
			<div class="panel panel-info text-center"><div class="panel-heading"><h3 class="panel-title">Сейчас показана <b><?=$week_all?></b> неделя.</h3></div></div>
			<ul class="pager">
  			<li class="previous"><a href="/?page=all-par&num=<?=$week_all-1?>">&larr; Предыдущая</a></li>
  			<li class="next"><a href="/?page=all-par&num=<?=$week_all+1?>">Следующая &rarr;</a></li>
			</ul>
			<div class="row">
			<?php
			for($num_day=1; $num_day<=6; $num_day++){
				if($week_all == $week && $num_day == $day_num)
					$co = 'style="background: #ffab60;"';
				else
					$co = '';
		?>
		<div class="col-md-4 col-xs-12" >
		<div <?=$co?> class="panel panel-default"><!--Вывод расписания на всю неделю-->
		<div class="panel-heading">
    		<h3 class="panel-title"><?=day($num_day)?></h3>
  		</div>
			<?php
				if($rez = $mysqli->query("SELECT * FROM raspis WHERE id_grup = $id_grup AND den = $num_day ORDER BY `para` ASC")){
					if(($rez->num_rows)>0){
						$num_par = 0;
						while($result = $rez->fetch_assoc()){
							$weeks = explode(", ", $result['weeks']);
							foreach($weeks as $week1){
								if($week1 == $week_all){
									$num_par++;
									$result['time'] = $result['time']=="" ? $time_start_par[$result['para']-1] : $result['time'];
									$prepod = str_replace('<span' ,'<span data-toggle="tooltip"', $result['prepod']);
									$list_par[$num_par] = '<tr class="bright bleft">
									<td rowspan="2" style="border-bottom: 2px solid #000000;"><b>'.$result['para'].'</b><br>'.$result['time'].'</td>
									<td colspan="2">'.$result['name'].' <span class="label label-default">'.$result['type'].'</span></td></tr>
									<tr class="bbottom bright"><td style="word-wrap: break-word;">'.$result['auditor'].'</td><td>'.$prepod.'</td></tr>';
									break;
								}
							}
						}
						if($num_par > '0'){
								/*
									$list_par[$result['para']] = '<li class="list-group-item"><p>
									<span class="label label-primary">Пара №'.$result['para'].'
									</span> <span class="label label-success">Аудитория: '.$result['auditor'].'</span>
									<p>'.$result['name'].'</p><span class="label label-default">
									'.$result['type'].'</span> <span class="label label-info">'.$result['prepod'].'</span></li>';
								*/
								
								/*
									$list_par[$result['para']] = '<tr class="bright bleft">
									<td rowspan="2" style="border-bottom: 2px solid #000000;"><b>'.$result['para'].'</b></td>
									<td>ауд.<br>'.$result['auditor'].'</td>
									<td>'.$result['prepod'].'<br>'.$result['type'].'</td></tr>
									<tr class="bbottom bright"><td colspan="2">'.$result['name'].'</td></tr>';
								*/
								/*
									$list_par[$result['para']] = '<tr class="bright bleft">
									<td rowspan="2" style="border-bottom: 2px solid #000000;"><b>'.$result['para'].'</b></td>
									<td colspan="2">'.$result['name'].' <span class="label label-default">'.$result['type'].'</span></td></tr>
									<tr class="bbottom bright"><td>'.$result['auditor'].'</td><td>'.$result['prepod'].'</td></tr>';
								*/
					?>
					<table class="table table-bordered">
						<thead>
							<tr class="btop bleft bbottom bright">
							<th class="text-center">№</th>
							<th class="text-center">ауд.</th>
							<th class="text-center">Преподаватель</th>
							</tr>
						</thead>
						<tbody class="text-center">
						<?php
						foreach ($list_par as $value11) {
							echo $value11;
						}
						?>
						</tbody>
					</table>
    				<?php 
    				}else
    					echo'<h2 class="text-center">Пар нет!</h2>';
    				}else
    					echo'<h2 class="text-center">Пар нет!</h2>';
    			}else
    				echo'<div class="alert alert-danger">Ошибка запроса</div>';
    		?>
		<!--Вывод расписания на всю неделю-->
		</div>
		</div>
		<?php
		unset($list_par);
		$rez->free();
		if($num_day == 3)
		echo'</div><div class="row">';
		}
		echo'</div>';
		}//---------------------------Вывод всей недели
		else{
		if(isset($_GET['day'])){
			if(htmlspecialchars($_GET['day']) != 0){
			?>
			<div class="alert alert-info">
				<div class="row text-center">
				<div class="col-md-4 col-xs-12"><h3 class="panel-title">Сейчас показана <b><?=$week_new?></b> неделя,</h3></div>
				<div class="col-md-4 col-xs-6"><h3 class="panel-title"><b><?=day($day_num_new)?></b></h3></div>
				<div class="col-md-3 col-xs-6"><h3 class="panel-title">Число: <b><?=$data_11?></b></h3></div>
				</div>
			</div>
			<?php
			}
		}
		?>
		<ul class="pager">
  		<li class="previous"><a href="/?day=<?=$day_11-1?>">&larr; Предыдущий</a></li>
  		<li class="next"><a href="/?day=<?=$day_11+1?>">Следующий &rarr;</a></li>
		</ul>
		
		
		<div class="row"><!--Основной вывод расписания-->
		<div class="col-xs-12 col-md-4 col-md-offset-4">
		<div style="background: " class="panel panel-default">
			<table class="table table-bordered">
				<thead>
					<tr class="btop bleft bbottom bright">
						<th class="text-center">№</th>
						<th class="text-center">ауд.</th>
						<th class="text-center">Преподаватель</th>
					</tr>
				</thead>
				<tbody class="text-center">
				<?php
				if(isset($error2)){			
					}elseif($num_par == 0){
						echo '<tr class="bbottom bright bleft"><td colspan="3"><h2 class="text-center">Пар нет!</h2></td></tr>';
					}else{
						foreach ($list_par as $value11) {
							echo $value11;
						}
					}
				?>
				</tbody>
			</table>
			</div>
		</div>
		</div><!--Основной вывод расписания-->
		
    <?php
    } //--------------------------------------------------------Основной вывод
    	}
    }
    }
    ?>
    </div><!-- /.container --> 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();
	});
	
	window.onload = function(){
		var list1 = document.getElementsByClassName("time_para");
		var list2 = [];
		if(list1[0]!=undefined){
		for (var i = 0; i < list1.length; i++) {
			var list3 = [];
    		list3[0] = parseInt(list1[i].innerText.substr(0,1));
    		list3[1] = parseInt(list1[i].innerText.substr(3,1));
    		if(list3[1] == 1){
	    		list3[1] = parseInt(list1[i].innerText.substr(3,2));
	    		list3[2] = parseInt(list1[i].innerText.substr(6,2));
	    		list3[3] = parseInt(list1[i].innerText.substr(9,2));
	    		list3[4] = parseInt(list1[i].innerText.substr(12,2));
    		}else{
				list3[2] = parseInt(list1[i].innerText.substr(5,2));
	    		list3[3] = parseInt(list1[i].innerText.substr(8,2));
	    		list3[4] = parseInt(list1[i].innerText.substr(11,2));
	    	}
	    	list2[i] = list3;
  		}
  		}
  	var lin = window.location.href;
  	var simb = lin.substr(lin.length-2,2);

	window.setInterval(function(){
		var date = new Date();
		date.setUTCHours(date.getUTCHours()+3);
		var hours = date.getUTCHours();
		var minutes = date.getMinutes();
		var seconds = date.getSeconds();

		if (minutes < 10) 
			minutes = '0' + minutes;
		if (seconds < 10) 
			seconds = '0' + seconds;
		if((simb=="f/")||(simb=="=0")){	
			if(list1[0]!=undefined){
				for (var i = 0; i < list1.length; i++) {
					var ii = i+1;
					var temp = "para_num_" + ii;
					var temp1 = document.getElementsByClassName(temp);
					if((hours==list2[i][1] && minutes>=list2[i][2]) || (hours==list2[i][3] && minutes<=list2[i][4]) || (list2[i][1]<hours && hours<list2[i][3])){
						temp1[0].style.background = "#ffab60";
						temp1[1].style.background = "#ffab60";
					}else{
						temp1[0].style.background = "#ffffff";
						temp1[1].style.background = "#ffffff";
					}
				}
			}
		}
		var str = hours + ':' + minutes + ':' + seconds;
		document.getElementById('clock').innerHTML = str;
	}, 1000);
	}
	</script>
  </body>
</html>

<?php
//$mysqli->query("INSERT INTO `raspis` (id_grup, para, day, name, type, weeks, auditor, prepod) VALUES ('id$id_grup', 4, 1, 'Социология', 'Практическое занятие', '2.4.6.8.10.12.16', '536/2', 'Стрельникова.Т')");
//$mysqli->query("INSERT INTO `grups` (`name`, `start`) VALUES ('ИКПИ-42', '2017-02-05')");
//$mysqli->query("UPDATE grups SET start=$start_grup WHERE id_grup=$id_grup");
 $mysqli->close();