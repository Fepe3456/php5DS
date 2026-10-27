<?php

/**
 * Genera HTML options per un dropdown menu da un array associativo
 * @param array $array Array di opzioni con "nome" chiave
 * @return void
 */
function generaOptionNome(array $array): void {
    foreach ($array as $element) {
        echo "<option value=\"" . htmlspecialchars($element["nome"]) . "\">" .
             htmlspecialchars($element["nome"]) . "</option>";
    }
}

/**
 * Calcola quanti giorni mancano alla data specificata
 * @param string $data_fine Data in formato Y-m-d
 * @return int Numero di giorni rimanenti (o -1 se è una data passata)
 */
function calcolaGiorniMancanti(string $data_fine): int {
    $oggi = date("Y-m-d");
    $diff = strtotime($data_fine) - strtotime($oggi);

    if ($diff < 0) {
        return -1; // Data passata
    }

    return (int) floor($diff / 86400);
}

/**
 * Calcola l'orario di fine a partire dall'inizio e durata
 * @param string $orario_inizio Ora di inizio in formato HH:mm
 * @param int $durata Durata in ore
 * @return string Orario di fine in formato HH:mm
 */
function calcolaOrarioFine(string $orario_inizio, int $durata): string {
    $start_h = (int) substr($orario_inizio, 0, 2);
    $start_m = (int) substr($orario_inizio, 3, 2);

    $total_minutes = ($start_h * 60) + $start_m + ($durata * 60);
    $end_h = intval($total_minutes / 60);
    $end_m = ($total_minutes % 60);

    return sprintf("%02d:%02d", $end_h, $end_m);
}

/**
 * Trova le specifiche di un laboratorio dal database
 * @param string $nome_lab Nome del laboratorio da cercare
 * @param array $laboratori Array dei laboratori disponibili
 * @return array|null Associative array con le specifiche o null se non trovato
 */
function trovaLaboratorio(string $nome_lab, array $laboratori): ?array {
    foreach($laboratori as $element) {
        if ($element["nome"] === $nome_lab) {
            return $element;
        }
    }
    return null;
}

/**
 * Verifica se il laboratorio ha sufficiente capienza per la classe
 * @param int $n_studenti Numero di studenti
 * @param string $lab Nome del laboratorio
 * @param array $laboratori Array dei laboratori disponibili
 * @return array Associativo con messaggio di risultato o null se errore
 */
function verificaCapienza(int $n_studenti, string $lab, array $laboratori): ?array {
    foreach($laboratori as $element) {
        if ($element["nome"] === $lab) {
            if ($n_studenti > $element["capienza"]) {
                return [
                    "messaggio" => "Troppi studenti nel laboratorio. Capienza: " . $element["capienza"],
                    "max_studenti" => $element["capienza"]
                ];
            }
            return [
                "messaggio" => "Il laboratorio ha abbastanza posti per la classe",
                "capaci_studenti" => $element["capienza"]
            ];
        }
    }
    return null; // Laboratorio non trovato
}

/**
 * Verifica la disponibilità oraria del laboratorio (08:00 - 17:00)
 * @param string $orario_inizio Ora di inizio in formato HH:mm
 * @param string $orario_fine Orario di fine in formato HH:mm
 * @return array Associativo con messaggio o null se errore
 */
function verificaDisponibilitaOraria(string $orario_inizio, string $orario_fine): ?array {
    $start_h = (int) substr($orario_inizio, 0, 2);
    $end_h = (int) substr($orario_fine, 0, 2);

    if ($start_h < 8 || $end_h > 17) {
        return [
            "messaggio" => "Non disponibile: l'orario è fuori dalle ore 08:00-17:00",
            "orario_válido" => false
        ];
    }

    if ($start_h === $end_h) {
        return [
            "messaggio" => "Errore: orario di fine deve essere successivo all'inizio",
            "orario_válido" => false
        ];
    }

    return [
        "messaggio" => "Disponibile",
        "orario_válido" => true
    ];
}
