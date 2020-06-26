<?php
function update_presenzaUscita( $tabel,$email,$colonna,$colonna2,$riga,$riga2) {
    
    $servername = "localhost";
    $username = "mytraining";
    $password = "";
    $dbname = "my_mytraining";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // prepare and bind
    $stmt = $conn->prepare("UPDATE $tabel SET $colonna=?, $colonna2=? WHERE email=? ");
    $stmt->bind_param("sss",$riga,$riga2,$email);
    
    
    $stmt->execute();
    //echo '<br>'.$stmt->error;
    //echo'Updated <br>'. $conn->connect_error;
    
    $stmt->close();
    $conn->close();
}


?>