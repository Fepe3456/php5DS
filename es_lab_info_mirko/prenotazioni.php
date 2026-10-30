<?php
session_start();

require_once "lab.php";
require_once "funzioni.php";

// Inizializza l'array delle prenotazioni in sessione
if (!isset($_SESSION['prenotazioni'])) {
    $_SESSION['prenotazioni'] = [];
}

$errore = "";
$inviato = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($inviato) {
    // dati form
    $docente  = $_POST['nome_docente'];
    $classe   = $_POST['classe'];
    $id_lab   = $_POST['laboratorio'];
    $data     = $_POST['data_prenotazione'];
    $ora      = $_POST['ora_inizio'];
    $durata   = $_POST['durata'];
    $studenti = $_POST['numero_studenti'];
    $attivita = $_POST['attivita'];

    // funzioni di funzioni.php
    $lab         = trovaLaboratorio($id_lab, $laboratori);
    $giorni      = calcolaGiorniMancanti($data);
    $ora_fine    = calcolaOraFine($ora, $durata);
    $capienza_ok = verificaCapienza($studenti, $lab['capienza']);
    $orario_ok   = verificaDisponibilitaOraria($ora, $durata);

    // Controllo degli errori
    if ($giorni < 0) {
        $errore = "La data selezionata è già passata!";
    } else if (!$orario_ok) {
        $errore = "L'attività deve svolgersi tra le 07:50 e le 16:20 (finirebbe alle $ora_fine).";
    } else if (!$capienza_ok) {
        $errore = "Il numero di studenti ($studenti) supera le postazioni del laboratorio ({$lab['capienza']}).";
    }

    // Salvataggio nell'array se non ci sono errori
    if ($errore == "") {
        $_SESSION['prenotazioni'][] = [
            "docente"        => $docente,
            "classe"         => $classe,
            "laboratorio"    => $lab['nome'],
            "data"           => $data,
            "ora_inizio"     => $ora,
            "ora_fine"       => $ora_fine,
            "giorni_mancanti" => $giorni,
            "studenti"       => $studenti,
            "attivita"       => $attivita
        ];

        // Ricarico la pagina con una richiesta normale (GET): così se premo F5 non reinvia il form
        header("Location: prenotazioni.php?ok=1");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Riepilogo Prenotazione</title>
</head>

<body>
    <div class="pagina">

        <?php
        // Errore (la pagina è stata aperta dal form, ma qualcosa non va)
        if ($errore != "") {
            echo "<p class='messaggio errore'><strong>ERRORE:</strong> $errore</p>";
        }

        // Prenotazione riuscita: mostro i dettagli dell'ultima prenotazione salvata
        if (isset($_GET['ok']) && !empty($_SESSION['prenotazioni'])) {
            $ultima = end($_SESSION['prenotazioni']);

            echo "<p class='messaggio successo'><strong>PRENOTAZIONE RIUSCITA!</strong></p>";
            echo "<h3>Dettagli:</h3>";
            echo "<ul>";
            echo "<li><strong>Docente:</strong> " . $ultima['docente'] . "</li>";
            echo "<li><strong>Classe:</strong> " . $ultima['classe'] . "</li>";
            echo "<li><strong>Laboratorio:</strong> " . $ultima['laboratorio'] . "</li>";
            echo "<li><strong>Data:</strong> " . $ultima['data'] . " (mancano " . $ultima['giorni_mancanti'] . " giorni)</li>";
            echo "<li><strong>Orario:</strong> dalle " . $ultima['ora_inizio'] . " alle " . $ultima['ora_fine'] . "</li>";
            echo "<li><strong>Studenti:</strong> " . $ultima['studenti'] . "</li>";
            echo "<li><strong>Attività:</strong> " . $ultima['attivita'] . "</li>";
            echo "</ul>";
        }
        ?>

        <hr>

        <!-- TABELLA DELLE PRENOTAZIONI SALVATE -->
        <h2>Tutte le Prenotazioni</h2>

        <?php
        if (empty($_SESSION['prenotazioni'])) {
            echo "<p>Nessuna prenotazione in memoria.</p>";
        } else {
            echo "<table>";
            echo "<tr>";
            echo "<th>Docente</th>";
            echo "<th>Classe</th>";
            echo "<th>Lab</th>";
            echo "<th>Data</th>";
            echo "<th>Orario</th>";
            echo "<th>Giorni Mancanti</th>";
            echo "</tr>";

            foreach ($_SESSION['prenotazioni'] as $p) {
                echo "<tr>";
                echo "<td>" . $p['docente'] . "</td>";
                echo "<td>" . $p['classe'] . "</td>";
                echo "<td>" . $p['laboratorio'] . "</td>";
                echo "<td>" . $p['data'] . "</td>";
                echo "<td>" . $p['ora_inizio'] . " - " . $p['ora_fine'] . "</td>";
                echo "<td>" . $p['giorni_mancanti'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>

        <a href="index.php" class="btn-secondario">← Nuova Prenotazione</a>

    </div>
</body>

</html>