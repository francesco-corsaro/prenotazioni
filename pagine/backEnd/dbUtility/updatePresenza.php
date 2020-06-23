<?php
function update_presenzaUscita( $tabel,$email,$colonna,$riga) {
    
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
    $stmt = $conn->prepare("UPDATE $tabel SET $colonna=? WHERE email=? ");
    $stmt->bind_param("ss",$riga,$email);
    
    
    $stmt->execute();
    echo '<br>'.$stmt->error;
    echo'Updated <br>'. $conn->connect_error;
    
    $stmt->close();
    $conn->close();
}

update_presenzaUscita('0623Pom','francescc@gmail.com','uscita','21:00');

?>