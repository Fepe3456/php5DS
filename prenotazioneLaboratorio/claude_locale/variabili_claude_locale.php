<?php

/**
 * Variabili globali per il sistema di prenotazione laboratori
 */

$classi = [
    [
        "nome" => "5A",
        "capienza" => 20,
        "id" => 1
    ],
    [
        "nome" => "5B",
        "capienza" => 22,
        "id" => 2
    ],
    [
        "nome" => "5C",
        "capienza" => 18,
        "id" => 3
    ]
];

$laboratori = [
    [
        "nome" => "S51",
        "capienza" => 20,
        "descrizione" => "Sala Sistemi - Postazioni: 10",
        "id" => 1
    ],
    [
        "nome" => "R39",
        "capienza" => 20,
        "descrizione" => "Reti e Comunicazioni - Postazioni: 10",
        "id" => 2
    ],
    [
        "nome" => "R40",
        "capienza" => 25,
        "descrizione" => "Reti ed Ecosistemi - Postazioni: 13",
        "id" => 3
    ]
];

/**
 * Restituisce l'ID della classe per un dato nome
 */
function getClasseById($nome) {
    foreach($classi as $element){
        if( $element["nome"] == $nome ){
            return $element["id"];
        }
    }
    return null;
}

/**
 * Restituisce l'ID del laboratorio per un dato nome
 */
function getLabById($nome) {
    foreach($laboratori as $element){
        if( $element["nome"] == $nome ){
            return $element["id"];
        }
    }
    return null;
}

/**
 * Calcola la differenza di capienza tra classe e laboratorio
 */
function getCapienzaDiff($nome_classe, $nome_lab) {
    $class_id = getClasseById($nome_classe);
    $lab_id = getLabById($nome_lab);

    if ($class_id && $lab_id) {
        return $classi[$class_id - 1]["capienza"] - $laboratori[$lab_id - 1]["capienza"];
    }
    return null;
}

?>
