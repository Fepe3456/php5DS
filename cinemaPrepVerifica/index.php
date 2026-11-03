<?php

require_once "film.php"; // Importare il file film.php 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazione Cinema</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <h1>Prenotazione</h1>

    <div class="container">
    <form action="prenota.php" method="POST" onsubmit="return verificaForm()"> <!-- Invia i dati del form tramite post a prenota.php -->

        <div class="grid-item">
            <label>Nome: </label>
            <input type="text" name="nome_cliente" required>
        </div>

        <div class="grid-item">
            <label>Cognome: </label>
            <input type="text" name="cognome_cliente" required>
        </div>

        <div class="grid-item">
            <label>Seleziona il Film: </label>
            <select name="film_selezionato" id="input_film_selezionato">
                <?php
                //Generazione del tag option per ogni elemento nell'array $film 
                    foreach($film as $codice => $f ){
                        echo "
                        <option value=\"{$codice}\">
                        {$codice} - {$f["titolo"]}, {$f["durata"]} minuti, {$f["prezzo"]}€, {$f["posti_disponibili"]} posti disponibili</option>
                        ";
                    }
                ?>
            </select>
        </div>

        <div class="grid-item">
            <label>Numero biglietti: </label>
            <input type="number" name="numero_biglietti">
        </div>
        
        <br><input type="submit" value="PRENOTA" name="input_submit">

    </form>
    </div>

    <script>
        function verificaForm(){
            let tf = true; 

            let nome = document.getElementsByName("nome_cliente")[0].value; // Assegno alla variabile nome il valore dell'elemento html con name="nome_cliente" 
            let cognome = document.getElementsByName("cognome_cliente")[0].value;
            let n_biglietti = document.getElementsByName("numero_biglietti")[0].value;

            if ( nome.trim() === "" ){
                alert("Inserire il nome!"); 
                tf = false; 
            }
            if ( cognome.trim() === "" ){
                alert("Inserire il cognome!"); 
                tf = false; 
            }
            if ( n_biglietti < 1 || n_biglietti > 10 ){
                alert("Il numero di biglietti deve essere compreso tra 1 e 10!"); 
                tf = false; 
            }

            return tf; 
        }
    </script>

</body>
</html>
