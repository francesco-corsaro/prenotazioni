<?php
//ALTER TABLE `0621Mat` ADD `preOrdine` INT(2) NOT NULL DEFAULT '00' AFTER `nome`;

function convert($var1,$var2,$var3) {
    
    $result=$var1.$var2;
    if ($var3<14) {
        $result=$result.'Mat';
    }else {
        $result=$result.'Pom';
    }
    
    return $result;
};

$tabel='0621Mat';//convert($month,$day,$hour);
$confPrenotazione='si';

$email='prova@insert';
$nome='prova insert';

include 'connect.php';

$stmt = $conn->prepare("INSERT INTO $tabel (email, nome, confPrenota) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $nome, $confPrenotazione);

$stmt->execute();

echo $stmt->error;

$stmt->close();
$conn->close();
