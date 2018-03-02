<?php
if(isset($_GET['day'])){
    if(htmlspecialchars($_GET['day']) != 0){
        include ('dayinfo.php');
    }
}
?>
<ul class="pager">
    <li class="previous"><a href="/?day=<?=$day_11-1?>">&larr; Предыдущий</a></li>
    <li class="next"><a href="/?day=<?=$day_11+1?>">Следующий &rarr;</a></li>
</ul>

<?php
echo get_table();
?>