<?php
$time = strtotime('+ 3 hour');
$data = date("d.m.Y H:i", $time);

echo $data;

//$html = file_get_contents('raspisanie/save.html');
//$html=iconv("cp1251", "utf-8", $html);
//$html = preg_replace("'charset=windows-1251'si", "charset=utf-8", $html, 1);
//file_put_contents('raspisanie/save.html', $html);

//$strok = file('raspisanie/save.html');
//echo '<table border="1"><tbody>';
//foreach($strok as $stro){
	//$pos = strpos($stro, '<tr>');
	//if(!($pos === FALSE)){
		
		//$pos = stristr($stro, '<tr>');
		//$pos = substr($pos, 0, strpos($pos, '</tbody>'));
		//echo $pos;
		//file_put_contents('raspisanie/save.txt', $pos);
	//}
//}
//echo '</tbody></table>';


/*
<td align="center">
<span style="color:4500ff;">
<strong>Оптимизация и математические методы принятия решений</strong>
</span>
<small>(Практические занятия)<br>
<span title="учебные недели">(2, 4, 5, 6, 8, 9, 10, 12, 16, 17, 18н)</span>
</small><br>
<span title="Савищенко Николай Васильевич"><i>Савищенко Н.В.</i></span>
<br> ауд.: 505/1<hr>
<span style="color:4500ff;">
<strong>Оптимизация и математические методы принятия решений</strong>
</span>
<small>(Лабораторная работа) <br>
<span title="учебные недели">(13н)</span></small><br>
<span title="Савищенко Николай Васильевич"><i>Савищенко Н.В.</i></span>
<br> ауд.: 505/1</td>
*/

$pos = file_get_contents('raspisanie/save.txt');

echo "<br>";
//echo $pos;
echo "<br><br>";
$grup = strip_tags(substr($pos, 0, strpos($pos, '</td>')+5));
echo $grup;
echo "<br>";
$pos = stristr($pos, '</td>');
$pos = stristr($pos, '<td');
$i=1;
do{
	$para = substr($pos, 0, strpos($pos, '</tr>')+5);
	if($para != '<tr></tr>'){
	$temp = explode(" ", strip_tags(substr($para, 0, strpos($para, '</td>')+5)));
	$num_par = $temp[0];
	$time_start_par = $temp[1];
	echo $num_par;
	echo "|";
	echo $time_start_par;
	echo "<br>";
	$para = stristr($para, '</td>');
	$para = stristr($para, '<td');

//echo "||";
	do{
		$den = substr($para, 0, strpos($para, '</td>')+5);
		if($den != '<td>&nbsp;</td>'){
			do{
			$name_par = strip_tags(substr($den, 0, strpos($den, '</span>')+7));
			echo $name_par;
			echo "|";
			$den = stristr($den, '<small>');
			$type_par = strip_tags(substr($den, 0, strpos($den, '<br>')+4));
			$type_par = substr($type_par, 1, strlen($type_par)-3);
			echo $type_par;
			echo "|";
			$den = stristr($den, '<span');
			$nedel = strip_tags(substr($den, 0, strpos($den, '<br>')+4));
			$nedel = substr($nedel, 1, strlen($nedel)-4);
			echo $nedel;
			echo "|";
			$den = stristr($den, '<br><span');
			$prepod_par = substr($den, 4, strpos($den, '</span>')+3);
			echo $prepod_par;
			echo "|";
			$den = substr($den, strpos($den, '</span>')+7);
			$temp = strpos($den, '<hr>');
			if($temp === FALSE){
				$temp = explode(" ", ltrim(strip_tags(substr($den, 0, strpos($den, '</td>')+5))));
				$aud_par = $temp[1];
				echo $aud_par;
				echo "<br>";
				break;
			}else{
				$temp = explode(" ", ltrim(strip_tags(substr($den, 0, strpos($den, '<hr>')+4))));
				$aud_par = $temp[1];
				echo $aud_par;
				echo "<br>";
				$den = stristr($den, '<hr>');
			}
			}while(1==$i);
			//echo $den;
			
		}
		//echo $den;
		$para = stristr($para, '</td>');
		if($para == '</td></tr>'){
			echo "$num_par пары закончились<br>";
			break;
		}
		$para = stristr($para, '<td');
	} while(1==$i);
	}
	$pos = stristr($pos, '</tr>');
	if($pos == '</tr>'){
		echo "расписание закончилось";
		break;
	}
	$pos = stristr($pos, '<tr>');
}while(1==$i);

//echo $pos;

?>