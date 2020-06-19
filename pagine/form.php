<?php 
session_start();
?>
<html>
    <head>
        <title>Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    	<h1>Nome del luogo</h1>
        <div class="modulo">
            <form method="POST" action="testPost.php">
                <input type="text" placeholder="Inserisci il nome">
                <input type="email" placeholder="Email">
                <div class="tempo">
                    <label for="arrive">Indica l'orario di arrivo</label>
                    <input type="time" name="arrive">
                </div>
                <div class="tempoSafari">
                    <label for="hour">Ore:</label>
                    <select id="hour" name="hour">
                    </select>

                    <label for="minute">Minuti:</label>
                    <select id="minute" name="minute">
                    </select>
                    <p>Orario gia selezionato</p>
                </div>

                <input type="submit" value="Conferma">
            </form>
        </div>
    </body>
</html>