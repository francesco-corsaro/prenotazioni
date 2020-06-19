<?php
session_start();
?>
<html>
    <head>
        <title>Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/select.css">
    </head>
    <body>
    	<h1>Nome del luogo</h1>
        <div class="modulo">
            <form method="POST" action="testPost.php">
                <input type="text" name="nome" placeholder="Inserisci il nome">
                <input type="email" name="email" placeholder="Email">
                <div class="tempo">
                    Indica in che giorno vorresti prenotare e clicca su 'Verifica' per controllare la disponibilita
                   <div class="whenDay">
                   		
                       <select id="day" name="day"></select>
                       <select id="month" name="month"></select>
                       <select id="year" name="year"></select>
                        <p></p>
                    </div>
                    <script type="text/javascript" src="js/populate.js"></script>
                  <!--  <script src="js/styleSelect.js"></script> -->
                    
                </div>

                <input type="submit" value="Conferma">
            </form>
        </div>
    </body>
</html>
