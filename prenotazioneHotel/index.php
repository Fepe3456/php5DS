<?php
require_once "camere.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazione Hotel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container">

        <h1>Prenota la tua camera!</h1>

        <form action="prenota.php" method="POST" onsubmit="return validaFormPost()">
            <p>Nome: </p><input type="text" name="nome_cliente" required>
            <br><p>Cognome: </p><input type="text" name="cognome_cliente" required>
            
            <br><p>Seleziona la camera: </p><select name="camera_selezionata">
                <?php
                    foreach($camere as $codice => $camera){
                        echo "<option value=\"{$codice}\">{$codice} - {$camera["tipo"]}, {$camera["prezzo"]}€, {$camera["posti"]} posti</option>";
                    }
                ?>
            </select>

            <br><p>Data arrivo: </p><input type="date" name="data_arrivo">
            <br><p>Numero notti: </p><input type="number" name="n_notti">
            <br><p>Numero ospiti: </p><input type="number" name="n_ospiti">

            <br><input type="submit" value="SUBMIT" name="button_submit_post">
        </form>

    </div>

    <script>
        function validaFormPost(){
            let tf = true; 

            let nome = document.getElementsByName("nome_cliente")[0].value; 
            let cognome = document.getElementsByName("cognome_cliente")[0].value; 
            let notti = document.getElementsByName("n_notti")[0].value; 
            let ospiti = document.getElementsByName("n_ospiti")[0].value; 

            if( nome.trim() === "" || cognome.trim() === "" ){
                alert("Inserire il nome e il cognome!"); 
                tf= false; 
            }
            if( notti < 1 || notti > 14 ){
                alert("Inserire come minimo 1 notte e al massimo 14!"); 
                tf = false; 
            }
            if( ospiti <= 0 ){
                alert("Il numero di ospiti deve essere maggiore di 0!"); 
                tf = false; 
            }

            return tf; 
        }
    </script>

</body>
</html>