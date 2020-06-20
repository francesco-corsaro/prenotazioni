<?php
session_start();
$nome=$_POST['nome'];
$email=$_POST['email'];
$ora=$_POST['hour'];
$minute=$_POST['minute'];

$hour=$_POST['day'];
$minute=$_POST['month'];

echo 'Il nome '.$nome.'<br>';
echo 'Email '.$email.'<br>';
echo 'Orario time '.$ora.':'.$minute.'<br>';
echo 'Giorno '.$hour.' :'.$minute.'<br>';