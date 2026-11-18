<?php

if( $_SERVER["REQUEST_METHOD"] === "POST"  ){
    $nomeCliente = $_POST["nomeCliente"];
    $cognome = $_POST["cognome"];
    $nomeProgetto = $_POST["nomeProgetto"];
    $tipo = $_POST["tipo"];
    $dataInizio = $_POST["dataInizio"];
    $oreSviluppo = $_POST["oreSviluppo"];
    $sviluppatori = $_POST["sviluppatori"];
    $manutenzione = $_POST["manutenzione"];
    $priorita = $_POST["priorita"];
};

require_once "funzioni.php"; 
require_once "progetti.php";

$tariffa_oraria = $progetti[$tipo]["tariffa_oraria"];
$costo_fisso = $progetti[$tipo]["costo_fisso"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preventivo</title>
</head>
<body>
    
    <p>Nome: <span><?php echo $nomeCliente; ?> </span></p>
    <p>Nome progetto: <span><?php echo $nomeProgetto; ?> </span></p>
    <p>Tipologia: <span><?php echo $progetti[$tipo]["tipo"]; ?> </span></p>
    <p>Data inizio: <span><?php echo $dataInizio; ?> </span></p>
    <p>Numero sviluppatori: <span><?php echo $sviluppatori; ?> </span></p>
    <p>Ore complessive: <span><?php echo $oreSviluppo; ?> </span>h</p>
    <p>Durata in giorni: <span><?php echo durataStimata($oreSviluppo, $sviluppatori); ?> </span>gg</p>
    <p>Tariffa oraria: <span><?php echo $tariffa_oraria; ?></span>h</p>
    <p>Costo di sviluppo: <span>
        <?php echo costoSviluppo($tariffa_oraria, $oreSviluppo, $costo_fisso); ?> 
    </span>€</p>
    <p>Costo fisso: <span><?php echo $costo_fisso; ?> </span>€</p>
    <p>Costi di manutenzione: <span><?php echo calcolaCostiAggiuntivi($manutenzione); ?> </span>€</p>
    <p>Priorità: <span><?php echo $priorita; ?> </span></p>
    <p>Subtotale: <span><?php 
        $subtotale = calcolaSubtotale($costo_fisso, $tariffa_oraria, $sviluppatori, $oreSviluppo, $priorita); 
        echo $subtotale; ?> </span>€</p>
    <p>Iva: <span><?php 
        $iva = calcolaIva($subtotale);
        echo $iva; ?> </span>€</p>
    <p>Totale preventivo: <span><?php echo calcolaPreventivo($subtotale, $iva); ?> </span>€</p>

</body>
</html>