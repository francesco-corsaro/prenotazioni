<?php
session_start();
$limitePosti=6; 


//riceve gli input

$email=htmlspecialchars($_GET['email']);
$oraPrenotazione=htmlspecialchars($_GET['oraPrenotazione']);
$tabel=htmlspecialchars($_GET['tabel']);


//pulisce gli input

$clean=0;

if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
    $clean=0;
    echo $email.' non valido';
 
    
} else {
    $clean=1;
}

$time = preg_match('#^([01]?[0-9]|2[0-3]):[0-5][0-9]?$#', $oraPrenotazione);

if ($time===1) {
    $clean=1;
} else {
    echo 'Orario non valido';
    $clean=0;
}

//aggiungo le altre variabili per l'inserimento nel database



//verifico se c'è ancora la disponibilità dei posti
if ($clean == 1) {
    
    
    $persons=0;
    include "dbUtility/connect.php";
    
    $sql="SELECT * FROM $tabel ";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            
            if ($row['confPrenota'] =='presente') {
                ++ $persons;
                
            }elseif ($row['confPrenota'] =='confermato'){
                $prenotazione="$day-$month-$year ". $row['prenotazione'];
                $ritardo=floor((strtotime("now")-strtotime($prenotazione))/60);    //calcola il ritardo della persona
                
                if ($ritardo <=15) {
                    ++ $persons ;
                    //rimandare a una funzione che elimina la prenotazione del ritardatario
                }
            }
        }
    } else {
        $persons=9999;
        $err=$conn->error;
    }
    $conn->close();
    
    if($persons==9999){
        echo 'Il giorno selezionato non è valido';
    } elseif ($persons > $limitePosti){
        echo 'Per un soffio hai perso il posto, prova con un altro orario o un altro giorno';
    }elseif ($persons <= $limitePosti){
        include 'dbUtility/update.php';
        update_prenotazione($tabel,$email,'confermato',$oraPrenotazione);
        
    }
} else {
    echo 'I valori inseriti non sono corretti';
}