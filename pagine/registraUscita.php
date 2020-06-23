<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email=htmlspecialchars ($_POST['email']) ;
    
    $tabel=date("H")>14? date("m").date("d").'Pom': date("m").date("d").'Mat';
    $time=date("H:i");
    //Esegue un controllo sulla presenza nella tabella e nella colonna
    $update="none";
    
    include "backEnd/dbUtility/connect.php";
    
    $sql="SELECT email, uscita FROM $tabel ";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            if ($row['email'] === $email && $row['uscita'] === '00' ) {
                $update='ok' ;
            }
        }
    }else {
        $persons=0;
    }
    $conn->close();
    if ($update==='ok') {
        include 'backEnd/dbUtility/updatePresenza.php';
        update_presenzaUscita( $tabel,$email,'confPrenota','uscita','uscito',$time);
        $mex='La registrazione dell\'uscita avvenuta con successo!';
    }else {
        $mex='Si è verificato un errore';
    }
    
    //'tabbella '.$tabel.' Ora '.$time.' email '.$email;
}
?>
<html>
    <head>
        <title>Registra uscita</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/select.css">
    </head>
    <body>
    	<h1>Nome del luogo</h1>
         <div class="modulo">
        
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
                
                <input type="email" name="email" placeholder="Email" required>
                
                <input type="submit" class="btn" id='control' value="Registra uscita">

                <div id="txtHint"><div id="txtHint"><?php echo $mex?></div></div>
                
        </form> 
        </div>
        
    </body>
</html>