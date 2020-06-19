<?php
session_start();
$nome=$_POST['nome'];
$email=$_POST['email'];
$arrive=$_POST['arrive'];
$hour=$_POST['hour'];
$minute=$_POST['minute'];

echo 'Il nome '.$nome.'<br>';
echo 'Email '.$email.'<br>';
echo 'Orario time '.$arrive.'<br>';
echo 'orario safari '.$hour.' :'.$minute.'<br>';