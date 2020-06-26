<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email=htmlspecialchars ($_POST['email']) ;
    
    $tabel=date("H")>14? date("m").date("d").'Pom': date("m").date("d").'Mat';
    $time=date("H:i");
    
    $update="none";
    
    
    
    include "backEnd/dbUtility/connect.php";
    
    $sql="SELECT * FROM $tabel ";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            if ($row['email'] === $email && $row['presenza'] === '00' ) {
               $update='ok' ;
            }
        }
    }else {
        $persons=0;
    }
    $conn->close();
    if ($update==='ok') {
        include 'backEnd/dbUtility/updatePresenza.php';
        update_presenzaUscita( $tabel,$email,'confPrenota','presenza','presente',$time);
        $mex='registrazione effettuata con successo';
    }else {
        $mex='Si è verificato un errore';
    }
    
}
?>
<html>
    <head>
        <title>Registra presenza</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/select.css">
    </head>
    <body>
    	<h1>Nome del luogo</h1>
         <div class="modulo">
        
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
                
                <input type="email" name="email" placeholder="Email" required>
                
                <input type="submit" class="btn" id='control' value="Registra presenza">

                <div id="txtHint"><?php echo $mex?></div>
                
        </form> 
        </div>
        
    </body>
</html>