<?php
session_start();
function convert($var1,$var2,$var3) {
   
    $result=$var1.$var2;
    if ($var3<14) {
        $result=$result.'Mat';
    }else {
        $result=$result.'Pom';
    }
    
    return $result;
};
$disponibilita=0;
$month=$_POST['month'];
$day=$_POST['day'];
$hour=$_POST['hour'];


if ($day<10) {
    $day='0'.$day;
}
if ($month<10) {
    $month='0'.$month;
}

$tabel=convert($month,$day,$hour);


include "connect.php";


$sql="SELECT contatore, email, nome FROM $tabel ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $person=$row['email'];
        
        ++ $disponibilita;
        
        
    }
}else {
    $disponibilita=0;
    $err=$conn->error;
}
$conn->close();

if ($disponibilita>0) {
    echo 'Ci sono '.$disponibilita.' persone';
}else {
    echo 'nessuna prenotazione '.$err;
}
echo '<br>tabella '.$tabel;
?>