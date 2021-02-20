<?php
require("config.php");
$next1 = isset($_GET['prep']);
if ($next1)
    $prepod = htmlspecialchars($_GET['prep']);
else 
    $prepod = "Преподаватель";
if($groups = $mysqli->query( "SELECT `teacher` FROM timetable WHERE (date>DATE_ADD(now(), INTERVAL -31 DAY)) GROUP BY `teacher` ORDER BY `teacher`")){
?>
<form>
	<div align="center" style="margin-bottom: 20px;">
		<div class="btn-group">
			<button style="width: 350px;" type="button" class="btn btn-lg btn-default dropdown-toggle" data-toggle="dropdown"><?php echo $prepod; ?> <span class="caret"></span></button>
			<ul style="min-width: 300px; width: 350px; text-align: center;" class="dropdown-menu" role="menu">
				<?php while($result = $groups->fetch_assoc()){ echo '<li><a style="white-space: normal; word-wrap: break-word;" href="?page=statement&prep='.$result['teacher'].'">'.$result['teacher'].'</a></li>'; } ?>
			</ul>
		</div>
	</div>
</form>
<?php
    }else
        echo'<div class="alert alert-danger">Ошибка запроса</div>';
	$dateStart = new DateTime("2021-01-01");
	$dateStop = new DateTime("2021-07-01");
	echo get_statement_table($prepod, $dateStart->getTimestamp(), $dateStop->getTimestamp());
?>
