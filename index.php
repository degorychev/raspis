<?php
	require("config.php");
	require("functions.php");
	require('components/setcookie.php');
	
	if(isset($_COOKIE['id_ulstu']) && isset($_COOKIE['pos_ulstu'])){
		if ($_COOKIE['pos_ulstu'] == 1){
			//$name_group = get_groupname($_COOKIE['id']);
			$name_group = $_COOKIE['id_ulstu'];
			$title = "| ".$name_group;
		}
		elseif ($_COOKIE['pos_ulstu'] == 2){
			//$name_group = get_teachername($_COOKIE['id']);//Костыли и велосипеды, надо выпиливать
			$name_group = $_COOKIE['id_ulstu'];
			$title = "| ".get_teachername_abbreviated($name_group);
		}
		else{
			$name_group = "";
			$title = "| ОШИБКА";
		}
	}else{
		$name_group = "";
		$title = "УлГТУ";
	}
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php echo '<title>Расписание '.$title.'</title>'; ?>
		<link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
		<meta name="theme-color" content="#4B5359">

<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.min.css" rel="stylesheet">

		<link href="css/font-awesome.css" rel="stylesheet">
		<link href="css/bootstrap-social.css" rel="stylesheet" type="text/css">
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
			.fullheight{
			min-height: 80vh;
			}
		</style>
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="fullheight">
			<?php include('components/navbar.php'); ?>
			<div style="margin-top: 70px;" class="container">
				<?php
				if($_GET['page'] == 'problem'){
					include('components/problem.php');
				}else if($_GET['page'] == 'problem_finder'){
					include('components/problem_finder.php');
				}else if($_GET['page'] == 'journal'){
					include('components/journal.php');
				}else if($_GET['page'] == 'сabinet_schedule'){
					include('components/cabinet.php');					
				}else{
					if(!isset($_COOKIE['id_ulstu']) or (!isset($_COOKIE['pos_ulstu'])) or (isset($_GET['p']))) //Выбор группы
					{
						include('components/setgroup.php');
					}else{
						include('components/infobar.php');
						if($_GET['page'] == 'all-par'){
							include('components/week.php');
						}else{
							include('components/oneday.php');
						}
					}
				}
				?>
			</div>
		</div>
		<?php include('components/footer.php'); ?>
        <?php include('components/scripts.php'); ?>
    </body>
</html>
