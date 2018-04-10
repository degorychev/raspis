<?php
session_start();
function validity1($den, $time, $prepod, $cab){
	require("config.php");
	if($rez = $mysqli->query("SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`teacher`='$prepod'))")){
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
	$rez->free();
	return true;
}
function validity2($den, $time, $prepod, $cab){
	require("config.php");
	if($rez = $mysqli->query("SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`cabinet`='$cab'))")){
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
	$rez->free();
	return true;
}

function get_problem_table($den, $time, $prepod, $cabinet){
	require("config.php");
	$output = '';
	if (!validity1(htmlspecialchars($den), htmlspecialchars($time), htmlspecialchars($prepod), htmlspecialchars($cabinet))){
		$output = $output."Преподаватель обнаружен в нескольких кабинетах одновременно!";
		$rez = $mysqli->query("SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`teacher`='$prepod'))");

		$output = $output.'<table border="1">';
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
			$output = $output.'<td>' . $data['date'] . '</td>';
			$output = $output.'<td>' . $data['timeStart'] . '</td>';
			$output = $output.'<td>' . $data['class'] . '</td>';
			$output = $output.'<td>' . $data['discipline'] . '</td>';
			$output = $output.'<td>' . $data['type'] . '</td>';
			$output = $output.'<td>' . $data['teacher'] . '</td>';
			$output = $output.'<td>' . $data['cabinet'] . '</td>';
			$output = $output.'<td>' . $data['file'] . '</td>';
			$output = $output.'</tr>';
		}
		
		$output = $output.'</tbody>';
		$output = $output.'</table>';

	}
	if (!validity2(htmlspecialchars($den), htmlspecialchars($time), htmlspecialchars($prepod), htmlspecialchars($cabinet))){
		$output = $output."В одном кабинете обнаружено несколько преподавателей одновременно!";
	
		$rez = $mysqli->query("SELECT * FROM timetable WHERE ((`date`='$den') and (`timeStart`='$time') and (`cabinet`='$cabinet'))");

		$output = $output.'<table border="1">';
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
			$output = $output.'<td>' . $data['date'] . '</td>';
			$output = $output.'<td>' . $data['timeStart'] . '</td>';
			$output = $output.'<td>' . $data['class'] . '</td>';
			$output = $output.'<td>' . $data['discipline'] . '</td>';
			$output = $output.'<td>' . $data['type'] . '</td>';
			$output = $output.'<td>' . $data['teacher'] . '</td>';
			$output = $output.'<td>' . $data['cabinet'] . '</td>';
			$output = $output.'<td>' . $data['file'] . '</td>';
			$output = $output.'</tr>';
		}
		
		$output = $output.'</tbody>';
		$output = $output.'</table>';

	}
	return $output;
}

function get_shedule($name_grup, $den){
	require("config.php");
	if($rez = $mysqli->query("SELECT * FROM timetable WHERE class = '$name_grup' AND `date`='$den' ORDER BY `timeStart` ASC")){
		if(($rez->num_rows)>0){
			$num_par = 0;
			while($result = $rez->fetch_assoc()){				
				$validation = ((validity1($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])) and (validity2($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])));
				$num_par++;
				$prepod = str_replace('<span' ,'<span data-toggle="tooltip"', $result['teacher']);
				$nachalo=strtotime($result['timeStart']."+3 HOUR");//Почему БЫЛО +1 час?
				$konec=strtotime($result['timeStop']."+3 HOUR");
				
				$conclusion ='test';
				if($validation)
					$conclusion='<span style="color: green;" class="glyphicon glyphicon-ok" title="Прошло проверку" aria-hidden="true"></span>';
				else
					$conclusion='<a href="?page=problem&date='.$result['date'].'&time='.$result['timeStart'].'&teacher='.$result['teacher'].'&cabinet='.$result['cabinet'].'"><span style="color: red;" class="glyphicon glyphicon-remove" title="Не прошло проверку, уточняйте в учебном отделе" aria-hidden="true"></span></a>';
				
                $list_par[$num_par] = '
                	<tr class="para_num_'.$num_par.' bright bleft">
					<td class="time_para" rowspan="2" style="border-bottom: 2px solid #000000;"><br>'.gmdate("H:i", $nachalo).'<br>'.gmdate("H:i", $konec).'</td>
					<td colspan="2">'.$result['discipline'].' <span class="label label-default">'.$result['type'].'</span> '.$conclusion.'</td></tr>
					<tr class="para_num_'.$num_par.' bbottom bright"><td style="word-wrap: break-word;">'.$result['cabinet'].'</td><td>'.$prepod.'</td></tr>';
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

function get_table($name_grup, $den)
{	
	$PARI = get_shedule($name_grup, $den);
	$print = '
					<table class="table table-bordered">
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
				$validation = ((validity1($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])) and (validity2($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])));
				$num_par++;
				$group = str_replace('<span' ,'<span data-toggle="tooltip"', $result['class']);
				$nachalo=strtotime($result['timeStart']."+3 HOUR");
				$konec=strtotime($result['timeStop']."+3 HOUR");
				
				$conclusion ='test';
				if($validation)
					$conclusion='<span style="color: green;" class="glyphicon glyphicon-ok" title="Прошло проверку" aria-hidden="true"></span>';
				else
				$conclusion='<a href="?page=problem&date='.$result['date'].'&time='.$result['timeStart'].'&teacher='.$result['teacher'].'&cabinet='.$result['cabinet'].'"><span style="color: red;" class="glyphicon glyphicon-remove" title="Не прошло проверку, уточняйте в учебном отделе" aria-hidden="true"></span></a>';
			
                $list_par[$num_par] = '
                	<tr class="para_num_'.$num_par.' bright bleft">
					<td class="time_para" rowspan="2" style="border-bottom: 2px solid #000000;"><br>'.gmdate("H:i", $nachalo).'<br>'.gmdate("H:i", $konec).'</td>
					<td colspan="2">'.$result['discipline'].' <span class="label label-default">'.$result['type'].'</span> '.$conclusion.'</td></tr>
					<tr class="para_num_'.$num_par.' bbottom bright"><td style="word-wrap: break-word;">'.$result['cabinet'].'</td><td>'.$group.'</td></tr>';
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
	if($rez = $mysqli->query("SELECT FIO as 'name' FROM prepodavatel_original WHERE ID = $id_prepod LIMIT 1")){
		if(($rez->num_rows) == 1){
			while($result = $rez->fetch_assoc()){
				$teacher_name = $result['name'];
			}
		}
		$rez->free();
	}
	
	return $teacher_name;
}

$monthes = array(
	1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
	5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
	9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря'
);
?>