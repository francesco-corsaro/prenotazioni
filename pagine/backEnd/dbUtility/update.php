<?php
function update_prenotazione( $tabel,$email,$confPrenota,$prenotazione) {
    
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
    $stmt = $conn->prepare("UPDATE $tabel SET confPrenota=?, prenotazione=?  WHERE email=? ");
    $stmt->bind_param("sss",$confPrenota,$prenotazione,$email);
    
    
    $stmt->execute();
    echo '<br>'.$stmt->error;
    echo'Updated <br>'. $conn->connect_error;
    
    $stmt->close();
    $conn->close();
}

update_prenotazione('0623Pom','francescc@gmail.com','confermato','18:00');