<?php if($rez = $mysqli->query( "SELECT groups_original.`ID` as 'id_grup', timetable.`class` as 'name' FROM timetable LEFT JOIN groups_original ON timetable.`class` = groups_original.`Naimenovanie` GROUP BY timetable.`class` ORDER BY timetable.`class`")){ ?>
	<table width=100%>
		<tr>
			<td valign="center">
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
			</td>
		</tr>
	</table>
<?php
}else
    echo'<div class="alert alert-danger">Ошибка запроса</div>';
?>