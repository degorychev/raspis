<?php
session_start();
function validity1($den, $time, $prepod, $cab){
	require("config.php");
	//if(strcmp($prepod,'Неизвестно')){
		if($rez = $mysqli->query("SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`teacher`='$prepod') and (`cabinet`!='0') and (`cabinet`!='Discord'))")){
			//echo "SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`teacher`='$prepod')) <br>";
			$num = mysqli_num_rows($rez);
			if ($num>1){
				$result = $rez->fetch_assoc();
				$normalkab=$result['cabinet'];
				while($result = $rez->fetch_assoc()){
					if($normalkab != $result['cabinet'])
					{
						$rez->free();
						return false;
					}
				}
			}
		}
	//}
	//$rez->free();
	return true;
}
function validity2($den, $time, $prepod, $cab){
	require("config.php");
	//if(strcmp($cab,'УК-2')){
		if($rez = $mysqli->query("SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`cabinet`='$cab') and `teacher`!='Неизвестно' and (`cabinet`!='Discord'))")){
			//echo "<br> SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`cabinet`='$cab')) <hr>";
			$num = mysqli_num_rows($rez);
			if ($num>1){
				$result = $rez->fetch_assoc();
				$normalprepod=$result['teacher'];
				while($result = $rez->fetch_assoc()){
					if($normalprepod != $result['teacher'])
					{
						$rez->free();
						return false;
					}
				}
			}
		}
	//}
	//$rez->free();
	return true;
}
function validity3($den, $time, $prepod, $cab){
	require("config.php");
	//if(strcmp($cab,'УК-2')){
		if($rez = $mysqli->query("SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`teacher`='$prepod') and `cabinet`!='0')")){
			//echo "<br> SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`cabinet`='$cab')) <hr>";
			$num = mysqli_num_rows($rez);
			if ($num>1){
				$result = $rez->fetch_assoc();
				$normaldisc=$result['discipline'];
				while($result = $rez->fetch_assoc()){
					if($normaldisc != $result['discipline'])
					{
						//echo "SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`teacher`='$prepod') and `cabinet`!='0') <hr>";
						$rez->free();
						return false;
					}
				}
			}
		}
	//}
	//$rez->free();
	return true;
}
function validity4($den, $time, $prepod, $cab){
	require("config.php");
	//if(strcmp($cab,'УК-2')){
		if($rez = $mysqli->query("SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`cabinet`='$cab') and `teacher`!='Неизвестно' and (`cabinet`!='Discord'))")){
			//echo "<br> SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`cabinet`='$cab')) <hr>";
			$num = mysqli_num_rows($rez);
			if ($num>1){
				$result = $rez->fetch_assoc();
				$normaldisc=$result['discipline'];
				while($result = $rez->fetch_assoc()){
					if($normaldisc != $result['discipline'])
					{
						$rez->free();
						return false;
					}
				}
			}
		}
	//}
	//$rez->free();
	return true;
}

function get_problem_table_node($query){
	require("config.php");
	$rez = $mysqli->query($query);
	$output = '';
	$output = $output.'<div class="table-responsive">';
	$output = $output.'<table class="table table-striped table-bordered table-condensed">';
	$output = $output.'<thead>';
	$output = $output.'<tr>';
	$output = $output.'<th>дата</th>';
	$output = $output.'<th>время</th>';
	$output = $output.'<th>группа</th>';
	$output = $output.'<th>дисциплина</th>';
	$output = $output.'<th>тип</th>';
	$output = $output.'<th>преподаватель</th>';
	$output = $output.'<th>кабинет</th>';
	$output = $output.'<th>файл</th>';
	$output = $output.'</tr>';
	$output = $output.'</thead>';
	$output = $output.'<tbody>';
		
		while($data = mysqli_fetch_array($rez)){ 
			$output = $output.'<tr>';
			$output = $output.'<td>' . date("d.m.Y", strtotime($data['date'])) . '</td>';
			$output = $output.'<td>' . date("H:i", strtotime($data['timeStart'])) . '</td>';
			$output = $output.'<td>' . $data['class'] . '</td>';
			$output = $output.'<td>' . $data['discipline'] . '</td>';
			$output = $output.'<td>' . $data['type'] . '</td>';
			$output = $output.'<td>' . $data['teacher'] . '</td>';
			$output = $output.'<td>' . $data['cabinet'] . '</td>';
			$output = $output.'<td>' . $data['file'] . '</td>';
			$output = $output.'</tr>';
		}
		
	$output = $output.'</tbody>';
	$output = $output.'</table></div>';
	return $output;
}

function get_problem_table($den, $time, $prepod, $cabinet){
	$output = '';
	if (!validity1(htmlspecialchars($den), htmlspecialchars($time), htmlspecialchars($prepod), htmlspecialchars($cabinet))){
		$output = $output.'<div class="alert alert-danger">Преподаватель ('.$prepod.') обнаружен в нескольких кабинетах одновременно!</div>';
		$output = $output.get_problem_table_node("SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`teacher`='$prepod'))");
	}
	if (!validity2(htmlspecialchars($den), htmlspecialchars($time), htmlspecialchars($prepod), htmlspecialchars($cabinet))){
		$output = $output.'<div class="alert alert-danger">В одном кабинете ('.$cabinet.') обнаружено несколько преподавателей одновременно!</div>';
		$output = $output.get_problem_table_node("SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`cabinet`='$cabinet'))");
	}
	if (!validity3(htmlspecialchars($den), htmlspecialchars($time), htmlspecialchars($prepod), htmlspecialchars($cabinet))){
		$output = $output.'<div class="alert alert-danger">У одного преподавателя ('.$prepod.') обнаружено несколько дисциплин одновременно!</div>';
		$output = $output.get_problem_table_node("SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`teacher`='$prepod'))");
	}
	if (!validity4(htmlspecialchars($den), htmlspecialchars($time), htmlspecialchars($prepod), htmlspecialchars($cabinet))){
		$output = $output.'<div class="alert alert-danger">В одном кабинете ('.$cabinet.') обнаружено несколько дисциплин одновременно!</div>';
		$output = $output.get_problem_table_node("SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`cabinet`='$cabinet'))");
	}
	return $output;
}

function get_TimeOnSite(){
	$context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
	$url = 'http://iatu.ulstu.ru/category/%D1%80%D0%B0%D1%81%D0%BF%D0%B8%D1%81%D0%B0%D0%BD%D0%B8%D0%B5/feed/';

	$xml = file_get_contents($url, false, $context);
	$xml = simplexml_load_string($xml);

	$mydate = $xml->channel->lastBuildDate;
	$timeonsite = strtotime($mydate);
	return $timeonsite;
}

function get_last_update(){
	require("config.php");

	$rez = $mysqli->query('SELECT `date_of_update` FROM timetable ORDER BY `date_of_update` DESC LIMIT 1');
		while($data = mysqli_fetch_array($rez)){ 
			$phpdate = strtotime($data['date_of_update']);
			//$mysqldate = date( 'd.m.Y H:i', $phpdate );
			return $phpdate;
		}
	return 'Ошибка';
}

function get_journal_table($group, $disc){
	require("config.php");
	$rez = $mysqli->query('select * from timetable where (class = "'.$group.'" and discipline = "'.$disc.'" and  date > "'.date("Y-m-d", $start_grup).'") order by date');
	$output = '';
	$output = $output.'<div class="table-responsive">';
	$output = $output.'<table class="table table-bordered table-condensed">';
	$output = $output.'<thead>';
	$output = $output.'<tr>';
	$output = $output.'<th>#</th>';
	$output = $output.'<th>Дата</th>';
	$output = $output.'<th>Время</th>';
	//$output = $output.'<th>Дисциплина</th>';
	$output = $output.'<th>Тип</th>';
	$output = $output.'<th>Преподаватель</th>';
	$output = $output.'<th>Кабинет</th>';
	$output = $output.'<th>Подгруппа</th>';
	$output = $output.'</tr>';
	$output = $output.'</thead>';
	$output = $output.'<tbody>';
	$today = strtotime(date('Y-m-d'));
	$schet = 0;
	$flag = false;
		while($data = mysqli_fetch_array($rez)){ 
			if ($today <= strtotime($data['date'])){
				$output = $output.'<tr class="bg-warning">';
				if (!$flag){
					$flag = true;
					$schet = 0;
				}
			}
			else
				$output = $output.'<tr class="bg-success">';

			$output = $output.'<td>' . ++$schet . '</td>';
			$output = $output.'<td>' . date("d.m.Y", strtotime($data['date'])) . '</td>';
			$output = $output.'<td>' . $data['timeStart'] . '</td>';
			//$output = $output.'<td>' . $data['discipline'] . '</td>';
			$output = $output.'<td>' . $data['type'] . '</td>';
			$output = $output.'<td>' . $data['teacher'] . '</td>';
			$output = $output.'<td>' . $data['cabinet'] . '</td>';
			$output = $output.'<td>' . $data['subgroup'] . '</td>';
			$output = $output.'</tr>';
		}
		
	$output = $output.'</tbody>';
	$output = $output.'</table></div>';
	return $output;
}

function get_discord_journal_table($date, $timestart, $timestop,$grupa,$god, $prepod){
	require("config.php");
	//echo "debug  "."SELECT * FROM sessions2 WHERE `connect_time` < '".$date." ".$timestop. "' AND `disconnect_time` > '".$date." ".$timestart. "' AND `role` = '".$grupa.'-'.$god."'";
	$zapros = "SELECT `user_id`, 
		`connect_time`, 
		`disconnect_time`, 
		IFNULL(nickname, username) AS 'user', 
		IF(`channel` LIKE 'Голос', `category`, `channel`) AS 'channel', 
		`role`  
	FROM sessions2 
	WHERE `connect_time` < '".$date." ".$timestop. "' 
		AND (`disconnect_time` > '".$date." ".$timestart. "' OR `disconnect_time` IS NULL)  
		AND `role` = '".$grupa.'-'.$god."' 
		AND `user_id` NOT IN (SELECT `user_id` FROM sessions2 
			WHERE `role` = 'Преподаватели' 
			AND IFNULL(nickname, username) NOT LIKE '%".$prepod."%' 
			GROUP BY `user_id`)
		ORDER BY `user`, `connect_time`";
	//echo "debug: ". $zapros;
	$rez = $mysqli->query($zapros);
	$output = '';
	$output = $output.'<div class="table-responsive">';
	$output = $output.'<table class="table table-bordered table-condensed">';
	$output = $output.'<thead>';
	$output = $output.'<tr>';
	$output = $output.'<th>Подключение</th>';
	$output = $output.'<th>Отключение</th>';
	$output = $output.'<th>Пользователь</th>';
	$output = $output.'<th>канал</th>';
	$output = $output.'</tr>';
	$output = $output.'</thead>';
	$output = $output.'<tbody>';
		while($data = mysqli_fetch_array($rez)){ 
			$output = $output.'<td>' . date("d.m.Y H:i:s", strtotime($data['connect_time'])) . '</td>';
			$date = "online";
			if(is_null($data['disconnect_time']) != true){
				$date = date("d.m.Y H:i:s", strtotime($data['disconnect_time']));
			}
			$output = $output.'<td>' . $date . '</td>';
			$output = $output.'<td>' . $data['user'] . '</td>';
			$output = $output.'<td>' . $data['channel'] . '</td>';
			$output = $output.'</tr>';
		}
		
	$output = $output.'</tbody>';
	$output = $output.'</table></div>';
	return $output;
}

function get_discord_count($date, $timestart, $timestop, $grupa, $god, $prepod){
	require("config.php");
	$zapros = "SELECT COUNT(DISTINCT(`user_id`)) as 'count' 
	FROM sessions2 
	WHERE `connect_time` < '".$date." ".$timestop. "' 
		AND (`disconnect_time` > '".$date." ".$timestart. "' OR `disconnect_time` IS NULL)  
		AND `role` = '".$grupa.'-'.$god."' 
		AND `user_id` NOT IN (SELECT `user_id` FROM sessions2 
			WHERE `role` = 'Преподаватели' 
			AND IFNULL(nickname, username) NOT LIKE '%".$prepod."%' 
			GROUP BY `user_id`)";
	//echo "debug: ". $zapros;
	$output = '-';
	$rez = $mysqli->query($zapros);	
		if($data = mysqli_fetch_array($rez)){
			$output =  $data['count'];
		}
	return $output;
}

function get_cabinet_table($cab, $date){
	require("config.php");
	$rez = $mysqli->query('select * from timetable where (cabinet = "'.$cab.'" and  date = "'.$date.'") ORDER BY `timeStart`;');
	$output = '';
	if(mysqli_num_rows($rez)!=0){
		$output = $output.'<div class="table-responsive">';
		$output = $output.'<table class="table table-bordered table-condensed">';
		$output = $output.'<thead>';
		$output = $output.'<tr>';
		$output = $output.'<th>#</th>';
		$output = $output.'<th>Время</th>';
		$output = $output.'<th>Группа</th>';
		$output = $output.'<th>Дисциплина</th>';
		$output = $output.'<th>Тип</th>';
		$output = $output.'<th>Преподаватель</th>';
		$output = $output.'<th>Кабинет</th>';
		$output = $output.'<th>Подгруппа</th>';
		$output = $output.'</tr>';
		$output = $output.'</thead>';
		$output = $output.'<tbody>';
		$today = strtotime(date('Y-m-d  H:i:s'));
		$schet = 0;
		$flag = false;
			while($data = mysqli_fetch_array($rez)){ 
				if ($today <= strtotime($data['date'].' '.$data['timeStart'])){//Исправить!
					$output = $output.'<tr class="bg-warning">';
					if (!$flag){
						$flag = true;
						$schet = 0;
					}
				}
				else
					$output = $output.'<tr class="bg-success">';

				$output = $output.'<td>' . ++$schet . '</td>';
				$output = $output.'<td>' . date("H:i", strtotime($data['timeStart'])) . '</td>';
				$output = $output.'<td>' . $data['class'] . '</td>';
				$output = $output.'<td>' . $data['discipline'] . '</td>';
				$output = $output.'<td>' . $data['type'] . '</td>';
				$output = $output.'<td>' . $data['teacher'] . '</td>';
				$output = $output.'<td>' . $data['cabinet'] . '</td>';
				$output = $output.'<td>' . $data['subgroup'] . '</td>';
				$output = $output.'</tr>';
			}
			
		$output = $output.'</tbody>';
		$output = $output.'</table></div>';
	}
	else
	{
		$output = '<div class="alert alert-success" role="alert">
			Похоже, в этот день кабинет пустует.
		</div>';
	}
	return $output;
}

function get_discord_table($date){
	$cab = "Discord";
	require("config.php");
	$rez = $mysqli->query('select * from timetable where (cabinet = "'.$cab.'" and  date = "'.$date.'") ORDER BY `timeStart`;');
	$output = '';
	if(mysqli_num_rows($rez)!=0){
		$output = $output.'<div class="table-responsive">';
		$output = $output.'<table class="table table-bordered table-condensed">';
		$output = $output.'<thead>';
		$output = $output.'<tr>';
		$output = $output.'<th>#</th>';
		$output = $output.'<th>Время</th>';
		$output = $output.'<th>Группа</th>';
		$output = $output.'<th>Дисциплина</th>';
		$output = $output.'<th>Тип</th>';
		$output = $output.'<th>Преподаватель</th>';
		$output = $output.'<th>Подгруппа</th>';
		$output = $output.'<th>Посещаемость</th>';
		$output = $output.'</tr>';
		$output = $output.'</thead>';
		$output = $output.'<tbody>';
		$today = strtotime(date('Y-m-d H:i:s'));
		$schet = 0;
		$flag = false;
			while($data = mysqli_fetch_array($rez)){ 
				if ($today <= strtotime($data['date'].' '.$data['timeStart'])){//Исправить!
					$output = $output.'<tr class="bg-warning">';
					if (!$flag){
						$flag = true;
						$schet = 0;
					}
				}
				else
					$output = $output.'<tr class="bg-success">';
				
				list($grupa, $kurs) = explode('-', $data['class']);
				$god = 2021-(int)($kurs{0});
				$prepod =  explode(" ", $data['teacher']);				
				
				$discord_otchet='<a href="?page=discord_otchet&date='.$data['date'].'&timeStart='.$data['timeStart'].'&timeStop='.$data['timeStop'].'&teacher='.$data['teacher'].'&group='.$data['class'].'"><span style="color: blue;" class="glyphicon glyphicon-th-list" title="Отчет о посещаемости" aria-hidden="true"></span></a>';
				$discord_count = get_discord_count($data['date'], $data['timeStart'], $data['timeStop'], $grupa, $god, $prepod[0]);

				$output = $output.'<td>' . ++$schet . '</td>';
				$output = $output.'<td>' . date("H:i", strtotime($data['timeStart'])) . '</td>';
				$output = $output.'<td>' . $data['class'] . '</td>';
				$output = $output.'<td>' . $data['discipline'] . '</td>';
				$output = $output.'<td>' . $data['type'] . '</td>';
				$output = $output.'<td>' . $data['teacher'] . '</td>';
				$output = $output.'<td>' . $data['subgroup'] . '</td>';
				$output = $output.'<td>' . $discord_otchet. ' ('.$discord_count.' человек)' . '</td>';
				$output = $output.'</tr>';
			}
			
		$output = $output.'</tbody>';
		$output = $output.'</table></div>';
	}
	else
	{
		$output = '<div class="alert alert-success" role="alert">
			В этот день занятий в Discord не зафиксировано.
		</div>';
	}
	return $output;
}

function get_shedule($name_grup, $den){
	require("config.php");
	if($rez = $mysqli->query("SELECT * FROM timetable WHERE class = '$name_grup' AND `date`='$den' ORDER BY `timeStart` ASC, `subgroup` ASC")){
		if(($rez->num_rows)>0){
			$num_par = 0;
			while($result = $rez->fetch_assoc()){
				if (!strcmp($result['cabinet'],'УК-2') or !strcmp($result['teacher'],'Неизвестно')){
					$validation = true;
				}else{
					$validation = ((validity1($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])) and 
					(validity2($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet']))  and 
					(validity3($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet']))  and 
					(validity4($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])));
				}

				$num_par++;
				$prepod = str_replace('<span' ,'<span data-toggle="tooltip"', $result['teacher']);
				$nachalo=strtotime($result['timeStart']);//Почему БЫЛО +1 час?
				$konec=strtotime($result['timeStop']);
				
				$conclusion ='';
				$warn_color = '';
				$discord_otchet = '';

				if(!$validation){
					$conclusion='<a href="?page=problem&date='.$result['date'].'&time='.$result['timeStart'].'&teacher='.$result['teacher'].'&cabinet='.$result['cabinet'].'"><span style="color: red;" class="glyphicon glyphicon-remove" title="Не прошло проверку, уточняйте в учебном отделе" aria-hidden="true"></span></a>';
					$warn_color = 'danger';
				}

				if ($result['cabinet'] == 'Discord'){
					$discord_otchet='<a href="?page=discord_otchet&date='.$result['date'].'&timeStart='.$result['timeStart'].'&timeStop='.$result['timeStop'].'&teacher='.$result['teacher'].'&group='.$result['class'].'"><span style="color: grey;" class="glyphicon glyphicon-th-list" title="Отчет о посещаемости" aria-hidden="true"></span></a>';
				}

                $list_par[$num_par] = '
                	<tr class="para_num_'.$num_par.' bright bleft">
					<td class="time_para" rowspan="2" style="border-bottom: 2px solid #000000;"><br>'.date("H:i", $nachalo).'<br>'.date("H:i", $konec).'</td>
					<td colspan="2" class="'.$warn_color.'">'.getStringSubGroup($result['subgroup']).$result['discipline'].' <span class="label label-default">'.$result['type'].'</span> '.$conclusion.'</td></tr>
					<tr class="para_num_'.$num_par.' bbottom bright"><td style="word-wrap: break-word;">'.$result['cabinet'].$discord_otchet.'</td><td>'.$prepod.'</td></tr>';
			}
			$rez->free();
			return $list_par;
        }
    }else{
		echo '<div class="alert alert-danger">Ошибка запроса расписания</div>';
		$rez->free();
		return false;
	}
}

function getStringSubGroup($subgr)
{
if($subgr == '0')
    return '[все] ';
else
    return '['.$subgr.' подгруппа] ';
}

function get_table($name_grup, $den)
{	
	$PARI = get_shedule($name_grup, $den);
	$print = '<table class="table table-bordered">
						<thead>
							<tr class="btop bleft bbottom bright">
								<th class="text-center">время</th>
								<th class="text-center">ауд.</th>
								<th class="text-center">Преподаватель</th>
							</tr>
						</thead>
						<tbody class="text-center">';
			if(count($PARI) == 0){
				$print = $print.'
							<tr class="bbottom bright bleft">
								<td colspan="3">
									<h2 class="text-center">Пар нет!</h2>
								</td>
							</tr>';
			}else{
				foreach ($PARI as $PARA) {
					$print = $print.$PARA;
				}
			}
			$print = $print.'
						</tbody>
					</table>';
	return $print;	
}

function get_shedule_teacher($name_teacher, $den){
	require("config.php");
	if($rez = $mysqli->query("SELECT * FROM timetable WHERE teacher = '$name_teacher' AND `date`='$den' ORDER BY `timeStart` ASC")){
		if(($rez->num_rows)>0){
			$num_par = 0;
			while($result = $rez->fetch_assoc()){
				if (!strcmp($result['cabinet'],'УК-2') or !strcmp($result['teacher'],'Неизвестно')){
					$validation = true;
				}else{
					$validation = ((validity1($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])) and 
					(validity2($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])) and 
					(validity3($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])) and 
					(validity4($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])));
				}
				$num_par++;
				$group = str_replace('<span' ,'<span data-toggle="tooltip"', $result['class']);
				$nachalo=strtotime($result['timeStart']);
				$konec=strtotime($result['timeStop']);
				
				$conclusion ='';
				$warn_color = '';
				$discord_otchet = '';
				
				if(!$validation){
					$conclusion='<a href="?page=problem&date='.$result['date'].'&time='.$result['timeStart'].'&teacher='.$result['teacher'].'&cabinet='.$result['cabinet'].'"><span style="color: red;" class="glyphicon glyphicon-remove" title="Не прошло проверку, уточняйте в учебном отделе" aria-hidden="true"></span></a>';
					$warn_color = 'danger';
				}
				
				if ($result['cabinet'] == 'Discord'){
					$discord_otchet='<a href="?page=discord_otchet&date='.$result['date'].'&timeStart='.$result['timeStart'].'&timeStop='.$result['timeStop'].'&teacher='.$result['teacher'].'&group='.$result['class'].'"><span style="color: grey;" class="glyphicon glyphicon-th-list" title="Отчет о посещаемости" aria-hidden="true"></span></a>';
				}
				
                $list_par[$num_par] = '
                	<tr class="para_num_'.$num_par.' bright bleft">
					<td class="time_para" rowspan="2" style="border-bottom: 2px solid #000000;"><br>'.date("H:i", $nachalo).'<br>'.date("H:i", $konec).'</td>
					<td colspan="2" class="'.$warn_color.'">'.$result['discipline'].' <span class="label label-default">'.$result['type'].'</span> '.$conclusion.'</td></tr>
					<tr class="para_num_'.$num_par.' bbottom bright"><td style="word-wrap: break-word;">'.$result['cabinet'].$discord_otchet.'</td><td>'.$group.'</td></tr>';
			}
			$rez->free();
			return $list_par;
        }
    }else{
		echo '<div class="alert alert-danger">Ошибка запроса расписания</div>';
		$rez->free();
		return false;
	}
}

function get_table_teacher($name_teacher, $den)
{	
	$PARI = get_shedule_teacher($name_teacher, $den);
	$print = '
					<table class="table table-bordered">
						<thead>
							<tr class="btop bleft bbottom bright">
								<th class="text-center">время</th>
								<th class="text-center">ауд.</th>
								<th class="text-center">Группа</th>
							</tr>
						</thead>
						<tbody class="text-center">';
			if(count($PARI) == 0){
				$print = $print.'
							<tr class="bbottom bright bleft">
								<td colspan="3">
									<h2 class="text-center">Пар нет!</h2>
								</td>
							</tr>';
			}else{
				foreach ($PARI as $PARA) {
					$print = $print.$PARA;
				}
			}
			$print = $print.'
						</tbody>
					</table>';
	return $print;	
}

function day_of_week($num){//--------------------------День недели буквами
	switch ($num){
		case 0:
			return "Воскресенье";
		case 1:
			return "Понедельник";
		case 2:
			return "Вторник";
		case 3:
			return "Среда";
		case 4:
			return "Четверг";
		case 5:
			return "Пятница";
		case 6:
			return "Суббота";
		case 7:
			return "Воскресенье";
	}
}

function get_groupname($id_group){
	require("config.php");
	$name_grup = "";
	if($rez = $mysqli->query("SELECT Naimenovanie as 'name' FROM groups_original WHERE ID = $id_group LIMIT 1")){
		if(($rez->num_rows) == 1){
			while($result = $rez->fetch_assoc()){
				$name_grup = $result['name'];
			}
		}
		$rez->free();
	}
	
	return $name_grup;
}
function get_teachername($id_prepod){
	require("config.php");
	$teacher_name = "";
	if($rez = $mysqli->query("SELECT Full_FIO as 'name' FROM prepodavatel_original WHERE ID = $id_prepod LIMIT 1")){
		if(($rez->num_rows) == 1){
			while($result = $rez->fetch_assoc()){
				$teacher_name = $result['name'];
			}
		}
		$rez->free();
	}
	
	return $teacher_name;
}

function get_teachername_abbreviated($fullname_teacher)
{
	$output = str_replace('.','',$fullname_teacher);
	$pieces = explode(" ", $output);
	$output = $pieces[0];

	$index = 1;
	$elements = count ($pieces);
	if($elements>1)
		while ($index < $elements) {
			$output = $output." ".mb_substr($pieces[$index], 0, 1).".";
			$index++;
		}
	return $output;
}


$monthes = array(
	1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
	5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
	9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря'
);
?>