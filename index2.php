<?php
	require("config.php");
    require("functions.php");
    
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    
    $vibr_grup = false;
?>
<!DOCTYPE html>
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
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
        <?php include('components/navbar.php'); ?>
        <div style="margin-top: 70px;" class="container">
			<?php
			if((!isset($_COOKIE['id'])) or $vibr_grup) //Выбор группы
			{
                include('components/setgroup.php');
            }else{
                include('components/infobar.php');
                include('components/oneday.php');
            }
			?>
        </div>
        <?php include('components/scripts.php'); ?>
    </body>
</html>