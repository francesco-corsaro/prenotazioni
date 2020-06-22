<?php
//ALTER TABLE `0621Mat` ADD `preOrdine` INT(2) NOT NULL DEFAULT '00' AFTER `nome`;


$confPrenotazione='inAttesa';



include 'connect.php';

$stmt = $conn->prepare("INSERT INTO $tabel (email, nome, confPrenota) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $nome, $confPrenotazione);

$stmt->execute();

//echo $stmt->error;

$stmt->close();
$conn->close();

echo 'inserisce i dati';