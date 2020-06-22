<?php



include 'connect.php';

// sql to create table
$sql = "CREATE TABLE $tabel (
contatore INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email 	varchar(50) NOT NULL,
nome TEXT NOT NULL,
confPrenota VARCHAR(10) NOT NULL,
prenotazione VARCHAR(12) NOT NULL DEFAULT '00',
presenza VARCHAR(12) NOT NULL DEFAULT '00',
uscita VARCHAR(12) NOT NULL DEFAULT '00',
oraRegistrazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>