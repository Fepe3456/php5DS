<?php

function nomeCompleto($nome, $cognome){
    return $nome . " " . $cognome; 
};

function trovaCamera($camere, $codice){
    $trovata = null;
    foreach($camere as $cod => $camera){
        if( $cod == $codice ){
            $trovata = $camera; 
        }
    }
    return $trovata; 
};

function verificaCapienza($camera, $ospiti){
    return ( $ospiti <= $camera["posti"] );
};

function calcolaTotale($prezzo, $notti){
    return $prezzo * $notti; 
}; 

function calcolaPartenza($arrivo, $notti){
    //strtotime() converte la data in numero di secondi passati dal 1° gennaio 1970 
    //Creo la nuova data con formato Y-m-d e come parametro passo il strtotime() che ha come parametro il valore della giornata di arrivo più i giorni che deve aggiungere
    $partenza = date( "Y-m-d", strtotime($arrivo . " + {$notti} days") ); 
    return $partenza;
};

?>