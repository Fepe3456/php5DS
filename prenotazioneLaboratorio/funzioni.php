<?php

function generaOptionNome($array){
    foreach($array as $element){
        $nome = $element["nome"]; 
        echo "<option value=\"{$nome}\">{$nome}</option>"; 
    }
}


function calcolaGiorniMancanti($data_fine){
    $oggi = date("Y-m-d"); 
    $gg_mancanti = $data_fine.getDay() - $oggi.getDay(); 
    return $gg_mancanti;
}


function calcolaOrarioFine($orario_inizio, $durata){
    $orario_fine = time();
    return $orario_fine; 
}

function trovaLaboratorio($lab, $laboratori){
    foreach($laboratori as $element){
        if( $element == $lab ){
            echo "<br>Nome: {$element["nome"]}     Capienza: {$element["capienza"]}"; 
        }
    }
}

function verificaCapienza($cl, $lab){
    $str = "Il laboratorio ha abbastanza posti per la classe"; 
    if( $cl["capienza"] > $lab["capienza"] ){
        $str = "Troppi studenti nel laboratorio"; 
    }
    return $str; 
}

?>

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