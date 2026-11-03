<?php

function nomeCompleto($nome, $cognome){
    return ( $nome . "" . $cognome); 
};

function trovaFilm($film, $codice){
    $trovato = null; 
    foreach($film as $c => $f ){
        if( $c == $codice ){
            $trovato = $codice . " - " . $f["titolo"] . ", " . $f["durata"] . " minuti, " . $f["prezzo"] . "€, " . $f["posti_disponibili"] . " posti disponibili"; 
        }
    }
    return $trovato;
};

function verificaPosti($film, $posti){
    $tf = "Disponibile"; 
    if ( !( $film["posti_disponibili"] - $posti > 0 ) ){
        $tf = "Non disponibile"; 
    }
    return $tf;
}; 

function calcolaTotale($prezzo, $posti){
    return ($prezzo * $posti);
}; 

function calcolaDurataOre($durata){
    $ore = (int)($durata / 60); 
    $minuti = $durata - ($ore * 60 ); 
    return ( $ore . "h e " . $minuti . "min"); 
};

?>