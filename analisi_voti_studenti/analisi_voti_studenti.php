<?php

$studenti = [
   ["Luca", "5A", 8],
   ["Sara", "5B", 7],
   ["Marco", "5A", 5],
   ["Giulia", "5C", 9],
   ["Andrea", "5B", 6]
];

function verificaEsito($voto){
    $esito = "Superato";
    if($voto<6){
        $esito = "Non superato"; 
    }
    return $esito; 
}

function calcolaStatistiche($studenti){
    $insufficienti = 0;
    $sufficienti = 0;
    $massimo = $studenti[0][2]; //Così prendo il valore del voto  ([2]) del primo studente ([0])

    foreach($studenti as [$nome, $classe, $voto]){
        if($voto >= 6){
            $sufficienti++; 
        }
        else{
            $insufficienti++; 
        }
        if( $voto > $massimo ){
            $massimo = $voto; 
        }
    }

    return [$sufficienti, $insufficienti, $massimo]; 
}

[$sufficienti, $insufficienti, $massimo] = calcolaStatistiche($studenti); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisi voti studenti</title>
    <link rel="stylesheet" href="style_analisi_voti.css">
</head>
<body>
    
    <h1>Esiti studenti</h1>
    <table id="table_esiti" border="1">
        <tr>
            <th>Nome</th>
            <th>Classe</th>
            <th>Voto</th>
            <th>Esito</th>
        </tr>
        <?php

            foreach($studenti as [$nome, $classe, $voto]){
                $esito = verificaEsito($voto); 
                echo "
                <tr>
                    <td>$nome</td>
                    <td>$classe</td>
                    <td>$voto</td>
                    <td>$esito</td>
                </tr>
                ";
            }

        ?>
    </table>


    <h1>Statistiche</h1>

    <p>Sufficienti <?php echo "$sufficienti"; ?></p>
    <p>Insufficienti <?php echo "$insufficienti"; ?></p>
    <p>Voto massimo <?php echo "$massimo"; ?></p>

</body>
</html>