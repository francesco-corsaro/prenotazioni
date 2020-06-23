<?php
session_start();
$limitePosti=6; //In questa variabile si setta il num massimo di ospiti

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

$oraPrenotazione=$hour.':'.$minutes; //da mandare nell'URL ()

if ($clean==1) {
    
    function convert($var1,$var2,$var3) {
        
        $result=$var1.$var2;
        if ($var3<14) {
            $result=$result.'Mat';
        }else {
            $result=$result.'Pom';
        }
        
        return $result;
    };
    
    $tabel=convert($month,$day,$hour);
    $persons=0;
    $tabelExsist='no';
    //Il seguente passaggio richiama la tabella scelta dall'utente
    //e restituisce la variabile $person in modo da sapere cosa fare
    
    include "dbUtility/connect.php";
    
    $sql="SELECT * FROM $tabel ";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            if ($row['email']==$email) {
                echo '<p class="etichetta marginSup marginInf">Hai già effettuato la registrazione per questo giorno</p>' ;
                $persons=9999;
                $conn->close();
                break;
            } 
            if ($row['contatore']>=1) {
                $tabelExsist='si';
            }
            if ($row['prenotazione'] !='00' && $row['presenza'] != '00' &&  $row['uscita'] == '00') {
                ++ $persons;
            }elseif ($row['prenotazione'] !=0 && $row['presenza'] == '00' &&  $row['uscita'] == '00'){
                $prenotazione="$day-$month-$year ". $row['prenotazione'];
                $ritardo=floor((strtotime("now")-strtotime($prenotazione))/60);    //calcola il ritardo della persona
                
                if ($ritardo <=15) {
                    ++ $persons ;
                }
            }
            
        }
    }else {
        $persons=0;
        $err=$conn->error;
    }
    $conn->close();
    
    //In base al valore di $person si avranno differenti opzioni
    
    if ($persons==9999){  //Non carica nulla
        echo '<p class="etichetta marginSup marginInf"><br>Controlla l\'e-mail</p>';
    }elseif ($persons == 0){
        //Crea una tabella se $row['confPrenota']!='inAttesa' (scrivere il programma)
        if ( $tabelExsist=='no') {
           include 'dbUtility/createTable.php'; 
        }
        
        include 'dbUtility/preOrdineInsert.php';
        
        //echo 'crea una tabella e inserisce i dati';
        
       // include 'dbUtility/preOrdineInsert.php';
    }elseif ($persons>=$limitePosti){
        echo '<div class="etichetta"> Non ci sono posti disponibili, seleziona altre date</div>';
        
    }elseif ($persons < $limitePosti){
        
        include 'dbUtility/preOrdineInsert.php';
    }
    
    

    //Invia email
    include 'mail/mail.php';
    $data=$day.'-'.$month.'-'.$year.' '.$hour.':'.$minutes;

    $corpo='<div style="width: inherit;background-color: #f5f5dc;padding: 20px; text-align: center;">
                <h3 style="text-align: center;">GingiDevelop</h3>
                <div style="width: 90%; text-align: center;background-color: #e9e9af;padding: 15px; display: block;margin: auto;"
                    <p>Ciao '.$nome.',<br>clicca su Prenota per completare l\'operazione:</p>
                    Stai prenotando un posto per giorno: '.$data.'
                    
                    <a href="http://mytraining.altervista.org/prenotazioni/pagine/confermaPrenotazione.php?email='.$email.'&oraPrenotazione='.$oraPrenotazione.'&tabel='.$tabel.'" style="  text-decoration: none;display: block; width: 20%;padding: 6px; margin-top: 30px;margin-left: auto; margin-right: auto; color: whitesmoke ;background-color: #c4c487;box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);border-radius: 25px; ">Prenota</a>
                </div>
            </div>';

    sendAemail($email,$corpo);

    echo '<p class="etichetta marginSup marginInf"> Abbiamo inviato una e-mail all\' indirizzo '.$email.'
                <br>apri l\'e-email per confermare la prenotazione.
                <br> Se non ti appare controlla nella cartella spam 
                <br> ATTENZIONE!! Per completare la prenotazione è necessario confermare la ricezione dell\'email</p>';
   
    
    

} else{
    echo '<br>le variabile non sono valide';
}