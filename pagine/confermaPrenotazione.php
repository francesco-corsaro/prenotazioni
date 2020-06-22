<?php
session_start();
?>
<html>
    <head>
        <title>Conferma prenotazione</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/select.css">
    </head>
    <body>
    	<h1>Nome del luogo</h1>
        <div class="modulo">
            <form method="POST" action="backEnd/dbUtility/select.php">
                
                <input type="email" name="email" placeholder="Email">
                
                <div class="btn" id='control'>Conferma prenotazione</div>

                <div id="txtHint"></div>
                
            </form>
        </div>
        <script type="text/javascript" src="js/populate.js"></script>
        <script src="js/disponibilita.js"></script> 
    </body>
</html>