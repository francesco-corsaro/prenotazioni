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
            <form method="POST" action="backEnd/dbUtility/select.php">
                <input type="text" name="nome" placeholder="Inserisci il nome" class="marginInf">
                <input type="email" name="email" placeholder="Email">
                <div class="tempo">
                <div class="etichetta marginInf">Seleziona la data e l'orario per verificare la disponibiltà</div>
                   <div class="whenDay marginSup">
                       <p id="err"></p>
                   <div class="etichetta">Data: </div>
                       <select id="day" name="day"></select>
                       <select id="month" name="month"></select>
                       <select id="year" name="year"></select>
                    </div>
                    <div class="whenDay">
                    <div class="etichetta">Orario: </div>
                    <select id="hour" name="hour"></select> :
                    <select id="minute" name="minute"></select>
                    </div>
                    <div class="btn" id='control'>Verifica disponibilità</div>
                </div>
                <div id="txtHint"></div>
                
            </form>
        </div>
        <script type="text/javascript" src="js/populate.js"></script>
        <script src="js/disponibilita.js"></script> 
    </body>
</html>
