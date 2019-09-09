<?php
//session_start();
if(isset($_GET['id'])){
    if(isset($_GET['pos'])){
        $pos = htmlspecialchars($_GET['pos']);
        $id = htmlspecialchars($_GET['id']);
        setcookie( "id_ulstu", $id, time()+(60*60*24*30), '/');
        setcookie( "pos_ulstu", $pos, time()+(60*60*24*30), '/');
        header("Location: .");
    }
    else
        echo 'ТЫ ВСЕ СЛОМАЛ!';
}
?>