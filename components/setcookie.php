<?php
//session_start();
if(isset($_GET['id'])){
    $id = htmlspecialchars($_GET['id']);
    setcookie( "id", $id, time()+(60*60*24*30), '/');
    header("Location:/");
}
?>