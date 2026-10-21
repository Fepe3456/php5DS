<?php

require_once "variabili.php"; 
require_once "funzioni.php"; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazione Laboratorio</title>
</head>
<body>


    <h1>PRENOTAZIONE LABORATORIO</h1>
    <form action="" method="POST">
        <p>Nome: <input type="text" name="nome" required> </p>
        <p>
            Classe: 
            <select name="select_classi" id="" required>
                <?php
                    generaOptionNome($classi); //$classi lo importo quando faccio require_once "variabili.php"; 
                ?>
            </select>
        </p>
        <p>
            Laboratori: 
            <select name="select_laboratori" id="">
                <?php
                    generaOptionNome($laboratori); //$laboratori lo importo quando faccio require_once "variabili.php"; 
                ?>
            </select>
        </p>
        <p>Data: <input type="date" name="data" required> </p>
        <p>Orario di inizio: <input type="time" name="orario"> </p>
        <p>Durata: <input type="number" name="durata"> </p>
        <p>Numero studenti: <input type="number" name="numero_studenti"> </p>
        <p>Tipo di attività: <input type="text" name="tipo_att"> </p>
        <button type="submit">PRENOTA</button>
    </form>

    <?php
        /*$data_fine = date("2026-10-25"); 
        echo calcolaGiorniMancanti($data_fine); 
        */

        $l = $laboratori[0]; 
        echo trovaLaboratorio($l, $laboratori); 

        $c = $classi[0]; 
        echo verificaCapienza($c, $l); 
    ?>
    
</body>
</html>

<!---
Realizza un'applicazione che consenta ai docenti di prenotare un laboratorio informatico attraverso un form HTML. Il form deve raccogliere: 
    nome* del docente, classe* che si vuole portare, laboratorio che si vuole prenotare, data* della prenotazione, ora di inizio, durata in ore, numero di studenti e tipo di attività.

Specifiche:
verifica che i campi obbligatori siano compilati. (laboratori simulati in un file a parte con array associativa)
Crea le seguenti funzioni:
---------------calcolaGiorniMancanti() – calcola quanti giorni mancano alla prenotazione.
---------------calcolaOraFine() – determina l'ora di fine dell'attività
---------------trovaLaboratorio() – restituisce le specifiche del laboratorio selezionato.
---------------verificaCapienza() – controlla che il numero di studenti non superi le postazioni disponibili.
----------------verificaDisponibilitaOraria() – controlla che l'attività si svolga tra le 08:00 e le 17:00.
Visualizza una pagina di riepilogo con i dati della prenotazione, le caratteristiche del laboratorio, i giorni mancanti e l'esito dei controlli.
Gestisci eventuali errori, come campi vuoti, date passate, capienza insufficiente o orari non validi.
-->