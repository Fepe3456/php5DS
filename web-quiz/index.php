<?php

$domande = [
    [
        "testo_domanda" => "Cosa fa il metodo session_start()?",
        "r1" => "Elimina l'ultima sessione",
        "r2" => "Inizializza la sessione",
        "r3" => "Interrompe momentaneamente la sessione corrente",
        "index_corretta" => "r2"
    ],
    [
        "testo_domanda" => "Dove sono memorizzati i risultati del quiz?",
        "r1" => "\$_SESSION",
        "r2" => "\$_POST",
        "r3" => "\$_GET",
        "index_corretta" => "r1"
    ],
    [
        "testo_domanda" => "Una sessione come viene identificata?",
        "r1" => "L'account dell'utente identifica la sessione",
        "r2" => "Una combinazione tra browser e informazioni del pc creano un id per la sessione",
        "r3" => "Una sessione è associata ad un id (identificativo)",
        "index_corretta" => "r3"
    ],
    [
        "testo_domanda" => "Come sono i dati di una sessione?",
        "r1" => "Dati persistenti",
        "r2" => "Dati volatili",
        "r3" => "Ogni 7 giorni si ripristinano",
        "index_corretta" => "r1"
    ],
    [
        "testo_domanda" => "Differenza tra Cookie e Sessione?",
        "r1" => "I dati di una sessione vengono salvati, mentre quelli dei cookies non vengono memorizzati",
        "r2" => "I dati di una sessione vengono salvati nel server, mentre quelli dei cookies vengono salvati nel browser",
        "r3" => "I dati di una sessione vengono salvati nel browser, mentre quelli dei cookies vengono salvati nel server",
        "index_corretta" => "r2"
    ]
];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <h1>WEB QUIZ</h1>
    
    <div id="quiz-container">

        <form action="risultati.php" method="POST">

            <?php

                $i=1;
                foreach($domande as $d){
                    echo "<h3>{$d["testo_domanda"]}</h3>";
                    echo "
                        <input type=\"radio\" name=\"domanda{$i}\" value=\"{$d["r1"]}\">{$d["r1"]}<br>
                        <input type=\"radio\" name=\"domanda{$i}\" value=\"{$d["r2"]}\">{$d["r2"]}<br>
                        <input type=\"radio\" name=\"domanda{$i}\" value=\"{$d["r3"]}\">{$d["r3"]}
                    ";
                    echo "<p>Risposta corretta: {$d["index_corretta"]}</p>";
                    $i++;
                }

            ?>

            <button name="button_submit" type="submit">SUBMIT</button>

        </form>

    </div>

    <button onclick="window.location.href='storico.php';">Visualizza storico</button>

</body>
</html>


<!--

Ragioniamo... rispondendo alle seguenti domande
    1. Perché è necessario chiamare session_start() prima di utilizzare $_SESSION?
Il metodo session_start() serve ad inizializzare la sessione se non esiste, altrimenti acquisisce quella già esistente. 
È necessario perché deve creare la sessione se non esiste oppure acquisirla se già esistente, e rende disponibile l'array globale $_SESSION. 

    2. Dove sono memorizzati i risultati del quiz?
I risultati del quiz vengono memorizzati in $_SESSION. 

    3. Come riconosce PHP le richieste provenienti dalla stessa sessione?
Con il metodo session_start() si associa alla sessione un identificativo, che serve a PHP per accedere ai dati della sessione. 

    4. Perché i dati della sessione non sono equivalenti a quelli di un cookie?
I dati di una sessione sono persistenti, perché i dati vengono conservati nel server per tutta la durata della sessione. 
Mentre i dati di un cookie hanno persistenza variabile, in quanto vengono salvati nel client / browser. 

-->