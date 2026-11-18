<?php 

$tipologie = [
    't1' => "sito_web",
    't2' => "app mobile"
];

$progetti = [
    "p1" => [
        "tipo" => $tipologie['t1'],
        "tariffa_oraria" => 15, 
        "costo_fisso" => 500
    ],
    "p2" => [
        "tipo" => $tipologie['t2'],
        "tariffa_oraria" => 20, 
        "costo_fisso" => 600
    ]
];

?>