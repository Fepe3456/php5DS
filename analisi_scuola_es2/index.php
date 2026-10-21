<?php
require_once 'studenti.php';
require_once 'funzioni.php';

[$sufficienti, $insufficienti, $massimo] = calcolaStatistiche($studenti); 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito scolastico modulare</title>
    <link rel="stylesheet" href="style_analisi_scuola_es2.css">
</head>
<body>

    <?php include 'headers.php'; ?>
    
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
    
    </table> <!-- Devo chiudere la tabella, perché in headers.php non l'ho chiusa, ho solamente iniziato con le intestazioni -->


    <form action="" method="GET">
        <p>Seleziona la classe: 
            <select name="menu_classi" id="">
                <option value="5A">5A</option>
                <option value="5B">5B</option>
                <option value="5C">5C</option>
            </select>
            <button type="submit">SELECT</button>
        </p>
    </form>

    <?php
        if( $_SERVER["REQUEST_METHOD"] === "GET"){
            $input_classe = $_GET["menu_classi"]; 
        }
    ?>

    <h1>Studenti <?php echo $input_classe?></h1>
    <table id="table_studenti_filtrati" border="1">
        <tr>
            <th>Nome</th>
            <th>Classe</th>
            <th>Voto</th>
            <th>Esito</th>
        </tr>

        <?php
            $studenti_filtrati = filtraPerClasse($studenti, $input_classe);
            //var_dump($studenti_filtrati); 
            foreach($studenti_filtrati as [$nome, $classe, $voto]){
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

    <p>Sufficienti: <?php echo "$sufficienti"; ?></p>
    <p>Insufficienti: <?php echo "$insufficienti"; ?></p>
    <p>Voto massimo: <?php echo "$massimo"; ?></p>
    <p>Percentuale sufficienti: <?php $p = calcolaPercentualeSuccesso($studenti); echo "$p%"; ?></p>

    
    <?php include 'footer.php'; ?>

</body>
</html>


<!--

Parte C - Sperimentazione
Esegui queste operazioni, osservando il comportamento di PHP e segnatelo in un file:

    - Carica due volte funzioni.php utilizzando require.
Se aggiungo due volte require 'funzioni.php'; visualizzo una pagina bianca, quindi si blocca tutto. 

    - Sostituisci require con require_once.
Se utilizzo due volte require_once non riscontro nessun problema, perché il file è già stato caricato una volta e alla seconda non lo ricarica. 

    - Prova a includere un file inesistente con include.
Ho aggiunto include 'pippo.php'; e continuo a visualizzare la pagina com'è, quindi non si blocca anche se pippo.php è un file inesistente. 

    - Ripeti utilizzando require.
Se scambio include con require nell'istruzione precedente, si blocca tutto e visualizzo una pagina bianca. Questo perché include continua anche se il file è inesistente, mentre require si blocca se trova un errore. 

-->