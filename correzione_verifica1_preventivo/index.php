<?php

session_start(); //Se non esiste inizializza la sessione, altrimenti acquisisce quella già esistente 

// Inizializza l'array del login in sessione
if (!isset($_SESSION['login'])) {
    $_SESSION['login'] = [];
}

function eliminaSessione(){
    session_unset();
    session_destroy(); 
};


    if( $_SERVER["REQUEST_METHOD"] === "GET"  ){
        $nomeClienteLogin = $_GET["nomeClienteLogin"];
    }

    $_SESSION['login']['nomeCliente'] = $nomeClienteLogin; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preventivo</title>
</head>
<body>
    
    <?php include "header.php"; ?>

    <form action="preventivo.php" method="POST" onsubmit="return check()">
        <label for="">Nome: <?php echo $nomeClienteLogin; ?> </label>
        <!-- <input type="text" name="nomeCliente" id="nomeCliente" required> -->
        
        <br><label for="">Cognome: </label>
        <input type="text" name="cognome" id="cognome" required>
        
        <br><label for="">Nome progetto: </label>
        <input type="text" name="nomeProgetto" id="nomeProgetto" required>
        
        <br><select name="tipo" id="tipo" required>
            <?php
                require_once "progetti.php";

                foreach($progetti as $chiave => $progetto){
                    echo "<option value=\"{$chiave}\">{$progetto['tipo']}</option>";                
                }
            ?>
        </select>
        <br><label for="">Data Inizio: </label>
        <input type="date" name="dataInizio" id="dataInizio" required>
        
        <br><label for="">Ori di sviluppo: </label>
        <input type="number" name="oreSviluppo" id="oreSviluppo" required>
        
        <br><label for="">Numero sviluppatori: </label>
        <input type="number" name="sviluppatori" id="sviluppatori" required>
        
        <br><label for="">Anni manutenzione: </label>
        <input type="number" name="manutenzione" id="manutenzione" required>

        <br><select name="priorita" id="priorita">
            <option value="0">Normale</option>
            <option value="1">Urgente</option>
        </select>

        <br><input type="submit" value="Ottieni un preventivo" name="button_submit" required>
    </form>

    <?php include "footer.php"; ?>

    <?php
        $_SESSION["login"][] = [
            "nomeCliente" => $corrette,
            "errate" => $errate,
            "percentuale" => $percentuale,
            "giudizio" => $giudizio
        ];
    ?>

    <script>
        function check(){
            let oreSviluppo = document.getElementById("oreSviluppo").value; 
            let sviluppatori = document.getElementById("sviluppatori").value; 
            let manutenzione = document.getElementById("manutenzione").value; 

            let tf = true; 

            if( oreSviluppo < 1 || oreSviluppo > 500 ){
                alert("Il numero di ore per lo sviluppo deve essere compreso tra 1 e 500!"); 
                tf = false; 
            }
            if( sviluppatori < 1 || sviluppatori > 5 ){
                alert("Il numero di sviluppatori deve essere compreso tra 1 e 5!");
                tf = false;  
            }
            if( manutenzione < 0 || manutenzione > 3 ){
                alert("Il numero di anni di manutenzione deve essere compreso tra 0 e 3!"); 
                tf = false; 
            }

            return tf; 
        }
    </script>

</body>
</html>