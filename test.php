<?php
	require("functions.php");
?>

<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Расписание</title>
		<link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.min.css" rel="stylesheet">
		<style>
			.btop{
			border-top: 2px solid #000000;
			}
			.bleft{
			border-left: 2px solid #000000;
			}
			.bright{
			border-right: 2px solid #000000;
			}
			.bbottom{
			border-bottom: 2px solid #000000;
			}
		</style>
	</head>
	<body>
	Время сейчас: <?php echo date('G:i:s',(time()+60*60*3));?>
	</body>
	</html>