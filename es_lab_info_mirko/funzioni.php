<?php

function trovaLaboratorio($idLab, $laboratori)
{
    if (isset($laboratori[$idLab])) {
        return $laboratori[$idLab];
    } else {
        return null;
    }
}


function calcolaGiorniMancanti($dataPrenotazione)
{
    $oggi = strtotime("today");
    $data = strtotime($dataPrenotazione);

    $differenzaSecondi = $data - $oggi;
    $giorni = $differenzaSecondi / 86400; // 86400 secondi = 1 giorno

    return (int)$giorni;
}   


function calcolaOraFine($oraInizio, $durata)
{
    $inizio = strtotime($oraInizio);
    $fine = strtotime("+$durata hours", $inizio);

    return date("H:i", $fine);
}


function verificaCapienza($numeroStudenti, $postazioniDisponibili)
{
    if ($numeroStudenti >= 10 && $numeroStudenti <= $postazioniDisponibili) {
        return true;
    } else {
        return false;
    }
}


function verificaDisponibilitaOraria($oraInizio, $durata)
{
    $inizio = strtotime($oraInizio);
    $fine = strtotime("+$durata hours", $inizio);

    $apertura = strtotime("07:50");
    $chiusura = strtotime("16:20");

    if ($inizio >= $apertura && $fine <= $chiusura) {
        return true;
    } else {
        return false;
    }
}
