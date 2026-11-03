<?php

// Includere i file film.php e funzioni.php 
require_once "film.php";
require_once "funzioni.php"; 


//Recupero dati form POST 
if ( $_SERVER["REQUEST_METHOD"] === "POST"  &&  isset($_POST["input_submit"]) ){
    $nome = $_POST["nome_cliente"];
    $cognome = $_POST["cognome_cliente"];
    $codice_film_selezionato = $_POST["film_selezionato"];
    $n_biglietti = $_POST["numero_biglietti"];
}

// var_dump($nome) . "<br>" . var_dump($cognome) . "<br>" . var_dump($codice_film_selezionato) . "<br>" . var_dump($n_biglietti) . "<br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riepilogo Prenotazione</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Riepilogo Prenotazione</h1><br><br>

    <div class="container" id="riepilogo_prenotazione">
        <p>Nome e Cognome: <?php 
                    $nome_completo = nomeCompleto($nome, $cognome);
                    echo $nome_completo; 
                    ?></p>
        <p>Film selezionato: <?php 
                    $info = trovaFilm($film, $codice_film_selezionato);
                    echo $info; 
                    ?></p>
        <p>Disponibilità biglietti: <?php 
                    $disp = verificaPosti($film[$codice_film_selezionato], $n_biglietti);
                    echo $disp; 
                    ?></p>
        <p>Totale: <?php 
                    $tot = calcolaTotale($film[$codice_film_selezionato]["prezzo"], $n_biglietti);
                    echo $tot . "€"; 
                    ?></p>
        <p>Durata: <?php 
                    $d = calcolaDurataOre($film[$codice_film_selezionato]["durata"]);
                    echo $d; 
                    ?></p>
    </div>

    <a href="index.php" class="link-home">TORNA ALLA SCHERMATA HOME</a>
</body>
</html>