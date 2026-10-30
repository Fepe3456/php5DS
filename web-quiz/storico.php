<?php 

session_start(); 

function eliminaSessione(){
    session_unset();
    session_destroy(); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storico</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <h1>Storico</h1>

    <?php
    
        //Se nella sessione esiste l'array storico 
        if( isset($_SESSION["storico"]) ){
            foreach( $_SESSION["storico"] as $risposta ){
                echo "
                    <div class='div_storico'>
                        <p>Corrette: {$risposta["corrette"]}</p>
                        <p>Errate: {$risposta["errate"]}</p>
                        <p>Percentuale: {$risposta["percentuale"]}%</p>
                        <p>Giudizio: {$risposta["giudizio"]}</p>
                    </div>
                ";
            }
        }
        else{
            echo "<p style=\"margin: 0 auto; border-radius: 20px; width: 20%; text-align: center; background-color: white; padding: 10px;\">Nessuna risposta fornita!</p>";
        }
    
    ?>

    <button onclick="eliminaSessione()">Cancella Storico</button>

    <button onclick="window.location.href='index.php';" id="button_index-php">Torna alla home</button>

</body>
</html>