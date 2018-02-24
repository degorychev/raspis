<?php
	session_start();
	if(isset($_GET['id'])){//-------------------------Куки id и названия группы
		$id = htmlspecialchars($_GET['id']);
		setcookie( "id", $id, time()+(60*60*24*30), '/');
		header("Location:/");
	}//-----------------------------------------------Куки id и названия группы
	elseif(isset($_COOKIE['id'])){//-----------Куки id группы
		$id = htmlspecialchars($_COOKIE['id']);
		setcookie( "id", $id, time()+(60*60*24*30), '/');
	}//----------------------------------------Куки id группы
	
	if(isset($_GET['p'])){//---------------------------Выбор группы
		$vibr_grup = true;
	}//------------------------------------------------Выбор группы
	
	function day($num111){//--------------------------День недели буквами
		switch ($num111){
			case 0:
				$day111 = "Воскресенье";
				break;
			case 1:
				$day111 = "Понедельник";
				break;
			case 2:
				$day111 = "Вторник";
				break;
			case 3:
				$day111 = "Среда";
				break;
			case 4:
				$day111 = "Четверг";
				break;
			case 5:
				$day111 = "Пятница";
				break;
			case 6:
				$day111 = "Суббота";
				break;
			case 7:
				$day111 = "Воскресенье";
				break;
		}
		return $day111;
	}//------------------------------------------------День недели буквами
	
	if(!((!isset($_COOKIE['id'])) or $vibr_grup)) //после Выбор группы
    {
		$id_grup = htmlspecialchars($_COOKIE['id']);
		if($rez = $mysqli->query("SELECT Naimenovanie as 'name' FROM groups_original WHERE ID = $id_grup LIMIT 1")){
			if(($rez->num_rows) == 1){
				while($result = $rez->fetch_assoc()){
					$name_grup = $result['name'];
					$start_grup = 1517792461;
					//$time_start_par = explode(" ", $result['time-start-par']);
					//$pin = $result['pin'];
				}
			$rez->free();
			//$week = 3;
			$week = (int)((date('z',(time()+60*60*3)) - date('z',$start_grup))/7)+1;
			$day_num = date('w',(time()+60*60*3));
			$den = date("Y-m-d");
			
			if($_GET['page'] == 'allow-edit-par'){}
			elseif($_GET['page'] == 'all-par'){}
			else{
				if(isset($_GET['day'])){
					$day_11 = htmlspecialchars($_GET['day']);
					$week_new = (int)((date('z',(strtotime('+'.$day_11.' day')+60*60*3)) - date('z',$start_grup))/7)+1;
					$day_num_new = $den = date("Y-m-d", strtotime($day_11." DAY")); 
					//date('w',(strtotime('+'.$day_11.' day')+60*60*3));
					$data_11 = date("d.m",(strtotime('+'.$day_11.' day')+60*60*3));
				}else{
					$day_11 = 0;
					$week_new = $week;
					$day_num_new = $day_num;
				}
				if($rez = $mysqli->query("SELECT * FROM timetable WHERE class = '$name_grup' AND `date`='$den' ORDER BY `timeStart` ASC")){
					if(($rez->num_rows)>0){
						$num_par = 0;
						while($result = $rez->fetch_assoc()){
							$num_par++;
							$result['time'] = $result['time']=="" ? $time_start_par[$result['para']-1] : $result['time'];
							$prepod = str_replace('<span' ,'<span data-toggle="tooltip"', $result['teacher']);
							$nachalo=strtotime($result['timeStart']."+1 HOUR");
							$konec=strtotime($result['timeStop']."+1 HOUR");
							$list_par[$num_par] = '<tr class="para_num_'.$num_par.' bright bleft">
							<td class="time_para" rowspan="2" style="border-bottom: 2px solid #000000;"><b>'.$result['para'].'</b><br>'.gmdate("H:i", $nachalo).'<br>'.gmdate("H:i", $konec).'</td>
							<td colspan="2">'.$result['discipline'].' <span class="label label-default">'.$result['type'].'</span></td></tr>
							<tr class="para_num_'.$num_par.' bbottom bright"><td style="word-wrap: break-word;">'.$result['cabinet'].'</td><td>'.$prepod.'</td></tr>';
						}
					}else{
						$num_par = 0;
					}
				}else{
					$alert2 = '<div class="alert alert-danger">Ошибка запроса расписания</div>';
					$error2 = FALSE;
				}
			} //--------------------------------------------------------Основной вывод
			
		}else{
			$alert = '<div class="alert alert-danger">Возможно ваша группа была удалена выберите из списка: <a href="/?p" class="alert-link">Выбрать</a></div>';
			$error1 = FALSE;
		}
	}else{
		$alert = '<div class="alert alert-danger">Ошибка запроса группы</div>';
		$error1 = FALSE;
	}
}			