<?php
require("config.php");
if($rez = $mysqli->query("select * from timetable where ((date>'2018-01-01') and (date<'2018-04-15')) order by date desc")){
	if(($rez->num_rows)>0){
		$num_par = 0;
		while($result = $rez->fetch_assoc()){				
            $validation = ((validity1($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])) and (validity2($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet'])));
            if (!$validation){
                echo get_problem_table($result['date'], $result['timeStart'], $result['teacher'], $result['cabinet']);
            }
		}
		$rez->free();
    }
}else{
	echo '<div class="alert alert-danger">Ошибка запроса расписания</div>';
	$rez->free();
}
?>