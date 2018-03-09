<?php
session_start();

function get_shedule($name_grup, $den){
	require("config.php");
	if($rez = $mysqli->query("SELECT * FROM timetable WHERE class = '$name_grup' AND `date`='$den' ORDER BY `timeStart` ASC")){
		if(($rez->num_rows)>0){
			$num_par = 0;
			while($result = $rez->fetch_assoc()){
				$num_par++;
				$prepod = str_replace('<span' ,'<span data-toggle="tooltip"', $result['teacher']);
				$nachalo=strtotime($result['timeStart']."+1 HOUR");
				$konec=strtotime($result['timeStop']."+1 HOUR");
                    
                $list_par[$num_par] = '
                	<tr class="para_num_'.$num_par.' bright bleft">
					<td class="time_para" rowspan="2" style="border-bottom: 2px solid #000000;"><br>'.gmdate("H:i", $nachalo).'<br>'.gmdate("H:i", $konec).'</td>
					<td colspan="2">'.$result['discipline'].' <span class="label label-default">'.$result['type'].'</span></td></tr>
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
				$num_par++;
				$group = str_replace('<span' ,'<span data-toggle="tooltip"', $result['class']);
				$nachalo=strtotime($result['timeStart']."+1 HOUR");
				$konec=strtotime($result['timeStop']."+1 HOUR");
                    
                $list_par[$num_par] = '
                	<tr class="para_num_'.$num_par.' bright bleft">
					<td class="time_para" rowspan="2" style="border-bottom: 2px solid #000000;"><br>'.gmdate("H:i", $nachalo).'<br>'.gmdate("H:i", $konec).'</td>
					<td colspan="2">'.$result['discipline'].' <span class="label label-default">'.$result['type'].'</span></td></tr>
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