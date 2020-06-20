<?php 
session_start();
$riceived=$_GET['q'];
echo $riceived;
echo'<br>';
$arr=array();
$arr= explode(",", $riceived);

foreach ($arr as $key => $value) {
    echo $key.' valore '.$value.'<br>';
}
?>

