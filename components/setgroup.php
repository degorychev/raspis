<?php 
if(($groups = $mysqli->query( "SELECT timetable.`group` as 'name' FROM timetable GROUP BY timetable.`group` ORDER BY timetable.`group`"))
&& ($prepods = $mysqli->query( "SELECT timetable.`teacher` AS 'name' FROM timetable WHERE CHAR_LENGTH(timetable.`teacher`) > 2 GROUP BY timetable.`teacher` ORDER BY timetable.`teacher`")))
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
							<?php while($result = $groups->fetch_assoc()){ echo '<li><a style="white-space: normal; word-wrap: break-word;" href="?id='.$result['name'].'&pos=1">'.$result['name'].'</a></li>'; } ?>
						</ul>
					</div>
					<div class="btn-group">
						<button style="width: 180px;" type="button" class="btn btn-lg btn-default dropdown-toggle" data-toggle="dropdown">Преподаватель <span class="caret"></span></button>
						<ul style="min-width: 100px; width: 180px; text-align: center;" class="dropdown-menu" role="menu">
							<?php while($result = $prepods->fetch_assoc()){ echo '<li><a style="white-space: normal; word-wrap: break-word;" href="?id='.$result['name'].'&pos=2">'.$result['name'].'</a></li>'; } ?>
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
