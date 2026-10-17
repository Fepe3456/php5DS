
<?php

function verificaEsito($voto) {
    if ($voto >= 6) {
        return "Superato";
    } else {
        return "Non superato";
    }
}

function calcolaStatistiche($studenti) {
    $sufficienti = 0;
    $insufficienti = 0;
    $massimo = 0;

    foreach ($studenti as [$nome, $classe, $voto]) {
        if ($voto >= 6) {
            $sufficienti++;
        } else {
            $insufficienti++;
        }

        if ($voto > $massimo) {
            $massimo = $voto;
        }
    }

    return [$sufficienti, $insufficienti, $massimo];
}


function trovaMiglioreStudente($studenti){
    $migliore = $studenti[0];
    foreach($studenti as [$nome, $classe, $voto]){
        if( $voto > $migliore["voto"]){
            $migliore = [
                "nome" => $nome,
                "classe" => $classe,
                "voto" => $voto
            ];
        }
    }
    return $migliore;
}

function filtraPerClasse($studenti, $classe){
    $studenti_filtrati = [];
    foreach($studenti as [$nome, $classeStudente, $voto]){
        if($classeStudente === $classe){
            $studenti_filtrati[] = [$nome, $classeStudente, $voto];
        }
    }
    return $studenti_filtrati;
}

function calcolaPercentualeSuccesso($studenti){
    $tot = count($studenti); 
    $sufficienti = 0;
    foreach($studenti as [$nome, $classe, $voto]){
        if($voto >= 6){
            $sufficienti++;
        }
    }
    $percentuale = $sufficienti / $tot * 100; 
    return $percentuale; 
}

?>
