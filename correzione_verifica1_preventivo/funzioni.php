<?php

function durataStimata($ore, $sviluppatori){
    $giorniDurata = $ore / ($sviluppatori * 8);
    return $giorniDurata;
};

function costoSviluppo($tariffa, $ore, $costoFisso){
    $costoSviluppo = $costoFisso + $tariffa*$ore;
    return $costoSviluppo; 
};

function calcolaCostiAggiuntivi($anni_manutenzione){
    return 50 * 12 * $anni_manutenzione; //50€ * 12mesi 
}; 

function calcolaSubtotale($costo_fisso, $tariffa_oraria, $sviluppatori, $ore, $priorita){
    $tot = $costo_fisso + $tariffa_oraria * $sviluppatori + $ore;
    if( $priorita == "urgente" ){
        $tot += 1000; 
    }
    return $tot; 
}; 

function calcolaIva($subtotale){
    return ( $subtotale * 22/100 ); 
}; 

function calcolaPreventivo($subtotale, $iva){
    $preventivo = $subtotale + $iva; 
    return $preventivo; 
}; 

?>