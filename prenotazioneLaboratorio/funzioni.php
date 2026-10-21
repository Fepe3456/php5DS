<?php

function generaOptionNome($array){
    foreach($array as $element){
        $nome = $element["nome"]; 
        echo "<option value=\"{$nome}\">{$nome}</option>"; 
    }
}


function calcolaGiorniMancanti($data_fine){
    $oggi = date("Y-m-d"); 
    $gg_mancanti = ( strtotime($data_fine) - strtotime($oggi) ) / 86400; 
    //Perché 86400? È il numero di secondi in un giorno: 24ore * 60minuti * 60secondi = 86400 
    return $gg_mancanti; 
}

//strtotime() converte la data in numero di secondi passati dal 1° gennaio 1970 

function calcolaOrarioFine($orario_inizio, $durata){
    $orario_fine = date("H:i",  (strtotime($orario_inizio) + $durata*3600) );
    return $orario_fine; 
}

function trovaLaboratorio($nome_lab, $laboratori){
    $str = "";
    foreach($laboratori as $element){
        if( $element["nome"] == $nome_lab ){
            $str .= "<br>Nome: {$element["nome"]}     Capienza: {$element["capienza"]}"; 
        }
    }
    return $str; 
}

function verificaCapienza($n_studenti, $lab, $laboratori){
    $str = "Il laboratorio ha abbastanza posti per la classe"; 
    foreach($laboratori as $element){
        if( $element["nome"] == $lab ){
            if( $n_studenti > $element["capienza"] ){
                $str = "Troppi studenti nel laboratorio"; 
            }
        }
    }
    return $str; 
}

function verificaDisponibilitaOraria($orario_inizio, $orario_fine){
    $str = "Disponibile"; 
    $start = strtotime($orario_inizio);
    $end = strtotime($orario_fine); 
    $min = strtotime("08:00");
    $max = strtotime("17:00"); 
    if( $start < $min || $end > $max ){
        $str = "Non disponibile"; 
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