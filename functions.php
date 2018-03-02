<?php
function get_table()
{
	function get_shedule($name_grup, $den)
	{
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
				return $list_par;
            }
        }else{
			echo '<div class="alert alert-danger">Ошибка запроса расписания</div>';
			return false;
		}
	}

	$PARI = get_shedule('АИСТбд-31', '2018-03-02');
	if($PARI){
		$print = '
		<div class="row"><!--Основной вывод расписания-->
			<div class="col-xs-12 col-md-4 col-md-offset-4">
				<div style="background: " class="panel panel-default">
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
					</table>
				</div>
			</div>
		</div><!--Основной вывод расписания-->';
		return $print;
	}
}
?>