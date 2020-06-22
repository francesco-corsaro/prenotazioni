<?php
session_start();

//riceve gli input

$riceived=htmlspecialchars($_GET['q']);
$arr=array();
$arr= explode(",", $riceived);


//pulisce gli input

$clean=0;
for ($i=0 ; $i < 7 ; $i++) {
    if ($i<5) {
        
        if (filter_var($arr[$i], FILTER_VALIDATE_INT) === 0 || !filter_var($arr[$i], FILTER_VALIDATE_INT) === false) {
            $clean=1;
        } else {
            $clean=0;
            echo 'Giorno non valido';
        break;
        }
    } elseif ($i==5) {
        $arr[$i] = filter_var($arr[$i], FILTER_SANITIZE_STRING);
    }else {
        $arr[$i]  = filter_var($arr[$i] , FILTER_SANITIZE_EMAIL);

        if (!filter_var($arr[$i], FILTER_VALIDATE_EMAIL) ) {
            $clean=0;
            echo $arr[$i].' non valido';
            break;
            
        } else {
            $clean=1;
           }

    } 
}

function add0($var){
    if ($var<10) {
        $var='0'.$var;
    }
    return  $var;
}

$year=$arr[0];
$month=add0($arr[1]);
$day=add0($arr[2]);
$hour=add0($arr[3]);
$minutes=add0($arr[4]);
$nome=$arr[5];
$email=$arr[6];

$oraPrenotazione=$hour.':'.$minutes; //da mandare nell'URL (ancora non inserito nel'url)

if ($clean==1) {
    

    //Invia email
    include 'mail/mail.php';
    $data=$day.'-'.$month.'-'.$year.' '.$hour.':'.$minutes;

    $corpo='<div style="width: inherit;background-color: #f5f5dc;padding: 20px; text-align: center;">
                <h3 style="text-align: center;">GingiDevelop</h3>
                <div style="width: 90%; text-align: center;background-color: #e9e9af;padding: 15px; display: block;margin: auto;"
                    <p>Ciao '.$nome.',<br>clicca su Prenota per completare l\'operazione:</p>
                    Stai prenotando un posto per giorno: '.$data.'
                    
                    <a href="http://mytraining.altervista.org/prenotazioni/pagine/confermaPrenotazione.php?email='.$email.'" style="  text-decoration: none;display: block; width: 20%;padding: 6px; margin-top: 30px;margin-left: auto; margin-right: auto; color: whitesmoke ;background-color: #c4c487;box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);border-radius: 25px; ">Prenota</a>
                </div>
            </div>';

    sendAemail($email,$corpo);

    echo '<p class="etichetta marginSup marginInf"> Abbiamo inviato una e-mail all\' indirizzo '.$email.'
                <br>apri l\'e-email per confermare la prenotazione.
                <br> Se non ti appare controlla nella cartella spam 
                <br> ATTENZIONE!! Per completare la prenotazione è necessario confermare la ricezione dell\'email</p>';
    
    //inserisce gli input nella tabella
    
    
    
    //se non esiste la tabella la crea
    
    //inserisce gli input nella tabell
    

} else{
    echo '<br>le variabile non sono pulite';
}