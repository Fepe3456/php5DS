<?php

require_once "funzioni.php"; 
require_once "camere.php"; 

if ( $_SERVER["REQUEST_METHOD"] === "POST"  &&  isset($_POST["button_submit_post"]) ){

    $nome = $_POST["nome_cliente"];
    $cognome = $_POST["cognome_cliente"];
    $camera_selezionata = $_POST["camera_selezionata"];
    $data_arrivo = $_POST["data_arrivo"]; 
    $notti = $_POST["n_notti"]; 
    $ospiti = $_POST["n_ospiti"]; 

};

$nome_completo = nomeCompleto($nome, $cognome); 
$camera_trovata = trovaCamera($camere, $camera_selezionata); 
$capienza_verificata = verificaCapienza($camera_trovata, $ospiti); 
$totale = calcolaTotale( ($camera_trovata["prezzo"]), $notti); 
$partenza = calcolaPartenza($data_arrivo, $notti); 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riepilogo Prenotazione</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container">
        <h1>Riepilogo prenotazione</h1>
        <?php
            if( $capienza_verificata ){
                echo "
                    <div id=\"riepilogo_prenotazione_verificata\">
                        <p>Nome e Cognome: {$nome_completo}</p>
                        <p>Camera: {$camera_selezionata} - {$camera_trovata["tipo"]}, {$camera_trovata["prezzo"]}€, {$camera_trovata["posti"]} posti </p>
                        <p>Data arrivo: {$data_arrivo}</p>
                        <p>Data partenza: {$partenza}</p>
                        <p>Numero notti: {$notti}</p>
                        <p>Numero ospiti: {$ospiti}</p>
                        <p>Totale da pagare: {$totale}€</p>
                    </div>
                ";
            }
            else{
                echo "
                    <div id=\"avviso_errore_prenotazione\">
                        <p>Attenzione: errore nella prenotazione --> la camera selezionata non è abbastanza grande per il numero di ospiti seleizonati!</p>
                    </div>
                "; 
            };
        ?>
    </div>

    <a href="index.php" class="link-home">Torna alla homepage</a>

</body>
</html>