<?php

session_start(); //Se non esiste inizializza la sessione, altrimenti acquisisce quella già esistente 

// Inizializza l'array dello storico in sessione
if (!isset($_SESSION['storico'])) {
    $_SESSION['storico'] = [];
}


require_once "funzioni.php"; //Includo le funzioni (quindi il file funzioni.php), perché mi serviranno in seguito in questo file (risultati.php)
//require_once "index.php"; //Mi serve importare index.php, perché ho all'interno la variabile $domande (potrei anche creare un file separato chiamato variabili.php oppure domande.php)

//Nelle seguenti 3 righe importo index.php, ma facendo così elimino l'html di index.php che non viene visualizzato insieme a quello di risultati.php, e così facendo mi rimangono i valori di $domande 
//Questa soluzione è stata chiesta all'ia come alternativa alla creazione di variabili.php o domande.php 
ob_start(); //Memorizzo temporaneamente quello che in realtà dovrebbe essere stampato 
require_once "index.php";
ob_end_clean(); //Elimino il contenuto del buffer 

//Quando sono state inviate le informazioni tramite post, aggiorno l'array risposte[] 
    if( $_SERVER["REQUEST_METHOD"] === "POST"  &&  isset($_POST["button_submit"]) ){
        $risposte = [
            $_POST["domanda1"] ?? "",
            $_POST["domanda2"] ?? "",
            $_POST["domanda3"] ?? "",
            $_POST["domanda4"] ?? "",
            $_POST["domanda5"] ?? ""
        ]; 


        [$corrette, $errate, $percentuale] = correggiQuiz($domande, $risposte); //Chiamo la funzione correggiQuiz per assegnare i relativi valori alle relative variabili corrette, errate e percentuale
        $giudizio = valutaRisultato($percentuale); //Chiamo la funzione valutaRisultato e assegno il valore alla variabile $giudizio 


        //Salvo i risultati nella sessione 
        $_SESSION["storico"][] = [
            "corrette" => $corrette,
            "errate" => $errate,
            "percentuale" => $percentuale,
            "giudizio" => $giudizio
        ];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultati</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div id="correzzione_quiz">
        <?php
            if( isset($_POST["button_submit"]) ){
                echo "
                    <h3>Correggi quiz</h3>
                    <p>Corrette: {$corrette}</p>
                    <p>Sbagliate: {$errate}</p>
                    <p>Percentuale: {$percentuale}%</p>
                ";
            }
        ?>
    </div>

    <div id="valutazione_quiz">
        <?php
            if( isset($_POST["button_submit"]) ){
                echo "<h3>Valutazione quiz --> {$giudizio}</h3>";
            }
        ?>
    </div>

    <button onclick="window.location.href='index.php';">Torna alla home</button>
    <button onclick="window.location.href='storico.php';">Visualizza storico</button>

</body>
</html>