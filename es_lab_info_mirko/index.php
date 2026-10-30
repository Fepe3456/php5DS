<?php

require_once "lab.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lab Info Prenotazioni</title>
</head>

<body>
    <h1>PRENOTAZIONI LAB INFORMATICA</h1>

    <form action="prenotazioni.php" method="post">

        <!-- NOME E CLASSE -->
        <div>
            <!-- name="nome_docente" -->
            <input type="text" name="nome_docente" id="nome" placeholder="Inserire nome docente..." required>

            <!-- Select 1 e 2 hanno i rispettivi value="1", value="A", ecc. -->
            <select id="select1" onchange="unisciValori()">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

            <select id="select2" onchange="unisciValori()">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="G">G</option>
                <option value="H">H</option>
                <option value="I">I</option>
            </select>

            <!-- Campo nascosto che invia la classe unita con name="classe" -->
            <input type="hidden" name="classe" id="classe_unita">

            <script>
                function unisciValori() {
                    const sel1 = document.getElementById('select1').value;
                    const sel2 = document.getElementById('select2').value;
                    document.getElementById('classe_unita').value = `${sel1}${sel2}`;
                }
                unisciValori();
            </script>

        </div>

        <!-- LABORATORI -->
        <select name="laboratorio" id="laboratorio" onchange="impostaMassimo()" required>
            <option value="">-- Seleziona Laboratorio --</option>
            <?php foreach ($laboratori as $lab): ?>
                <option value="<?= $lab['id'] ?>" data-capienza="<?= $lab['capienza'] ?>">
                    <?= $lab['nome'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- DATA, ORA E DURATA -->
        <div>
            <!-- name="data_prenotazione" e name="ora_inizio" -->
            <input type="date" name="data_prenotazione" id="data_prenotazione" min="<?= date('Y-m-d') ?>" required>
            <input type="time" name="ora_inizio" id="ora_inizio" min="07:50" max="14:40" step="3000" required>

            <!-- name="durata" con valori numerici in ore (1, 2, 3) -->
            <select name="durata" id="durata" required>
                <option value="1">1 Ora</option>
                <option value="2">2 Ore</option>
                <option value="3">3 Ore</option>
            </select>
        </div>

        <!-- NUMERO STUDENTI E ATTIVITÀ -->
        <div class="colonna">
            <!-- name="numero_studenti" e name="attivita" -->
            <input type="number" name="numero_studenti" id="numero_studenti" placeholder="Numero di studenti..." min="10" required>

            <script>
                // Quando scelgo il laboratorio, il numero di studenti non può superare la sua capienza
                function impostaMassimo() {
                    const lab = document.getElementById('laboratorio');
                    const capienza = lab.options[lab.selectedIndex].dataset.capienza;

                    // Se non è scelto nessun laboratorio, capienza non esiste e il limite sparisce
                    document.getElementById('numero_studenti').max = capienza || "";
                }
            </script>



            <textarea name="attivita" id="attivita" placeholder="Tipo di attività..." required></textarea>
        </div>

        <button type="submit">Invia Prenotazione</button>




        <a href="prenotazioni.php" class="btn-secondario">Vedi Prenotazioni</a>

    </form>


</body>

</html>