<?php
//session_start();
if(isset($_GET['weekview'])){
	$weekview = htmlspecialchars($_GET['weekview']);
    setcookie( "weekview", $weekview, time()+(60*60*24*30), '/');
    header("Location: .");
}
?>