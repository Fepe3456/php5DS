<?php

require_once "variabili.php";
require_once "funzioni.php";

session_start();

/**
 * Sanitizza un input testo eliminando HTML e XSS
 */
function sanitize($input) {
    $input = htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    return $input;
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazione Laboratorio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>PRENOTAZIONE LABORATORIO</h1>

    <?php
    $errore = null;
    $successo = false;

    // Gestione form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $form_nome = sanitize($_POST["nome"] ?? "");
        $form_classe = $_POST["select_classi"] ?? "";
        $form_laboratori = $_POST["select_laboratori"] ?? "";
        $form_data = $_POST["data"] ?? "";
        $form_orario_inizio = $_POST["orario_inizio"] ?? "08:00";
        $form_durata = (int) ($_POST["durata"] ?? 1);
        $form_n_studenti = (int) ($_POST["numero_studenti"] ?? 0);
        $form_tipo_att = sanitize($_POST["tipo_att"] ?? "");

        // Validazioni
        if (empty($form_nome)) {
            $errore = "Il nome è obbligatorio.";
        } elseif (!date_exists($form_data)) {
            $errore = "La data deve essere una data valida.";
        } elseif ($form_durata <= 0) {
            $errore = "La durata deve essere almeno 1 ora.";
        } elseif ($form_n_studenti <= 0) {
            $errore = "Il numero di studenti deve essere maggiore di 0.";
        } else {
            // Calcoli e verifiche
            $orario_fine = calcolaOrarioFine($form_orario_inizio, $form_durata);
            $gg_mancanti = calcolaGiorniMancanti($form_data);
            $disp_oraria = verificaDisponibilitaOraria($form_orario_inizio, $orario_fine);
            $verifica_capienza = verificaCapienza($form_n_studenti, $form_laboratori, $laboratori);

            $errore = $verifica_capienza["messaggio"] ?? "";
        }
    }
    ?>

    <form action="" method="POST">
        <p>
            <label for="nome">Nome docente *</label><br>
            <input type="text" name="nome" id="nome" value="<?= $form_nome ?? '' ?>" required autocomplete="off">
        </p>

        <p>
            <label for="select_classi">Classe *</label><br>
            <select name="select_classi" id="select_classi" required>
                <?php
                    generaOptionNome($classi);
                ?>
            </select>
        </p>

        <p>
            <label for="select_laboratori">Laboratorio *</label><br>
            <select name="select_laboratori" id="select_laboratori" required>
                <?php
                    generaOptionNome($laboratori);
                ?>
            </select>
        </p>

        <p>
            <label for="data">Data * *</label><br>
            <input type="date" name="data" id="data" required min="<?= date("Y-m-d") ?>">
        </p>

        <p>
            <label for="orario_inizio">Orario di inizio *</label><br>
            <input type="time" name="orario_inizio" id="orario_inizio" value="08:00" min="08:00" max="16:59">
        </p>

        <p>
            <label for="durata">Durata (in ore) *</label><br>
            <input type="number" name="durata" id="durata" value="2" min="1" max="8" required>
        </p>

        <p>
            <label for="numero_studenti">Numero studenti *</label><br>
            <input type="number" name="numero_studenti" id="numero_studenti" value="1" min="1" max="50" required>
        </p>

        <p>
            <label for="tipo_att">Tipo di attività *</label><br>
            <input type="text" name="tipo_att" id="tipo_att" required autocomplete="off">
        </p>

        <button type="submit" name="prenotazione_btn">PRENOTA</button>
    </form>

    <?php if ($errore !== null || $successo): ?>
        <div class="alert">
            <?php
            if ($errore) {
                echo "
                    <p style='color: red;'><strong>Errore:</strong> {$errore}</p>";
            } else {
                echo "
                    <p style='color: green;'><strong>Prenotazione effettuata con successo!</strong></p>

                    <h3>Riepilogo della prenotazione</h3>
                    <ul>
                        <li><strong>Docente:</strong> <?= $form_nome ?></li>
                        <li><strong>Classe:</strong> <?= $form_classe ?></li>
                        <li><strong>Laboratorio:</strong>
                            <?php if ($caratteristiche_lab) echo htmlspecialchars($caratteristiche_lab["nome"]); else echo "Non specificato"; ?>
                        </li>
                        <li><strong>Data:</strong> <?= $form_data ?></li>
                        <li><strong>Orario:</strong> <?= $form_orario_inizio ?> - <?= $orario_fine ?></li>
                        <li><strong>Durata:</strong> {$form_durata} ore</li>
                        <li><strong>Studenti:</strong> {$form_n_studenti}</li>
                        <li><strong>Tipo attività:</strong> <?= $form_tipo_att ?></li>
                    </ul>

                    <?php
                        if ($disp_oraria) {
                            echo "<p style='color: green;'>✅ Disponibilità oraria: " . htmlspecialchars($disp_oraria["messaggio"]) . "</p>";
                        } else {
                            echo "<p style='color: red;'>❌ Errore: " . htmlspecialchars($disp_oraria["message"] ?? $errore) . "</p>";
                        }

                        if ($verifica_capienza) {
                            echo "<p style='color: green;'>✅ Capienza: " . htmlspecialchars($verifica_capienza["messaggio"]) . "</p>";
                        } else {
                            echo "<p style='color: red;'>❌ Errore: capienza non verificata</p>";
                        }

                        if ($gg_mancanti !== null) {
                            echo "<p style='color: blue;'>📅 Giorni mancanti: {$gg_mancanti}</p>";
                        }
                    ?>

                    <a href='index.php' class='btn-ripristina'>Nuova prenotazione</a>
                ";
            }
            ?>
        </div>
    <?php endif; ?>

</body>
</html>

<!--
Realizza un'applicazione che consenta ai docenti di prenotare un laboratorio informatico attraverso un form HTML.
Il form deve raccogliere: nome*, classe*, laboratorio*, data*, ora di inizio, durata in ore, numero di studenti e tipo di attività.

Specifiche:
- Verifica che i campi obbligatori siano compilati (laboratori simulati in variabili.php)
- Crea le seguenti funzioni:
  - calcolaGiorniMancanti(): calcola quanti giorni mancano alla prenotazione
  - calcolaOrarioFine(): determina l'ora di fine dell'attività
  - trovaLaboratorio(): restituisce le specifiche del laboratorio selezionato
  - verificaCapienza(): controlla che il numero di studenti non superi le postazioni disponibili
  - verificaDisponibilitaOraria(): controlla che l'attività si svolga tra le 08:00 e le 17:00

Visualizza una pagina di riepilogo con i dati della prenotazione, le caratteristiche del laboratorio,
i giorni mancanti e l'esito dei controlli.
-->
