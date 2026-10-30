<?php 


function correggiQuiz($domande, $risposte) {
    //La funzione deve restituire  tre valori: numero di risposte corrette, numero di risposte errate e percentuale di successo.
    $corrette = 0;
    $errate = 0; 
    $i = 0;
    foreach($domande as $d){
        //$index = $d["index_corretta"];
        if( $d[ $d["index_corretta"] ] == $risposte[$i] ){
            $corrette++;
        }else{
            $errate++; 
        }
        $i++;
    }
    $percentuale = $corrette / count($risposte) * 100; 
    return [$corrette, $errate, $percentuale]; 
}

function valutaRisultato($percentuale) {
    $giudizio = "Percentuale non valida"; //Inizializzazione con un messaggio d'errore (in caso non sia compresa tra 0-100 )
    if( $percentuale >= 0  &&  $percentuale < 60 ){
        $giudizio = "Da migliorare!";
    }
    else if( $percentuale < 80 ){
        $giudizio = "Sufficiente"; 
    }
    else if( $percentuale < 100 ){
        $giudizio = "Buono"; 
    }
    else if ( $percentuale == 100 ){
        $giudizio = "Eccellente!"; 
    }
    return $giudizio; 
}

?>