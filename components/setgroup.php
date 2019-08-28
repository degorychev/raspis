<?php 
if(($groups = $mysqli->query( "SELECT groups_original.`ID` as 'id_grup', timetable.`class` as 'name' FROM timetable LEFT JOIN groups_original ON timetable.`class` = groups_original.`Naimenovanie`  WHERE (date>DATE_ADD(now(), INTERVAL -331 DAY)) GROUP BY timetable.`class`, groups_original.`ID` ORDER BY timetable.`class`"))
&& ($prepods = $mysqli->query( "SELECT prepodavatel_original.`ID` as 'id_prepod', timetable.`teacher` as 'name' FROM timetable LEFT JOIN prepodavatel_original ON timetable.`teacher` = prepodavatel_original.`Full_FIO`  WHERE ((date>DATE_ADD(now(), INTERVAL -31 DAY)) AND (prepodavatel_original.`ID` != 38)) GROUP BY timetable.`teacher`, prepodavatel_original.`ID`  ORDER BY timetable.`teacher`")))
{ ?>
	<table width=100%>
		<tr>
			<td valign="center">
				<div align="center">
					<div class="page-header"><h1>Привет</h1></div>
	       			<p>Представься, пожалуйста.</p>
					<div class="btn-group">
						<button style="width: 180px;" type="button" class="btn btn-lg btn-default dropdown-toggle" data-toggle="dropdown">Группа <span class="caret"></span></button>
						<ul style="min-width: 100px; width: 180px; text-align: center;" class="dropdown-menu" role="menu">
							<?php while($result = $groups->fetch_assoc()){ echo '<li><a style="white-space: normal; word-wrap: break-word;" href="?id='.$result['id_grup'].'&pos=1">'.$result['name'].'</a></li>'; } ?>
						</ul>
					</div>
					<div class="btn-group">
						<button style="width: 180px;" type="button" class="btn btn-lg btn-default dropdown-toggle" data-toggle="dropdown">Преподаватель <span class="caret"></span></button>
						<ul style="min-width: 100px; width: 180px; text-align: center;" class="dropdown-menu" role="menu">
							<?php while($result = $prepods->fetch_assoc()){ echo '<li><a style="white-space: normal; word-wrap: break-word;" href="?id='.$result['id_prepod'].'&pos=2">'.$result['name'].'</a></li>'; } ?>
						</ul>
					</div>
				</div>
			</td>
		</tr>
	</table>
<?php
}else
    echo'<div class="alert alert-danger">Ошибка запроса</div>';
?>
