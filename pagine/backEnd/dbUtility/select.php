<?php
session_start();

$limitePosti=6; //In questa variabile si setta il num massimo di ospiti
function convert($var1,$var2,$var3) {
   
    $result=$var1.$var2;
    if ($var3<14) {
        $result=$result.'Mat';
    }else {
        $result=$result.'Pom';
    }
    
    return $result;
};

function add0($var){
    if ($var<10) {
        $var='0'.$var;
    }
    return  $var;
}
$riceived=$_GET['q'];
$arr=array();
$arr= explode(",", $riceived);
$year=$arr[0];
$month=$arr[1];
$day=$arr[2];
$hour=$arr[3];
$minutes=$arr[4];

$tabel=convert($month,$day,$hour);

$persons=0;

include "connect.php";


$sql="SELECT * FROM $tabel ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row['prenotazione'] !=0 && $row['presenza'] != '00' &&  $row['uscita'] == '00') {
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

if ($persons>=$limitePosti) {
    echo ' Non ci sono posti disponibili';
}else {
    echo' Abbiamo la disponibilità, premi su conferma per prenotare';
    echo ' <input type="submit" class="btn" value="Conferma">   ';
}


//echo '<br>tabella '.$tabel;
?>