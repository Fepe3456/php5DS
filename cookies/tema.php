<?php

if( $_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["btn_applica"]) ){
    $tema = $_GET["tema"]; 
    setcookie("tema", $tema, time() + 86400); 
    $_COOKIE["tema"] = $tema; //Mi serve perché se non aggiorno il valore del cookie contiene ancora quello della richiesta precedente 
    //Esempio: ho messo dark, ma non visualizzavo dark, appena ho caricato la pagina però sì --> ecco perché scrivo al riga 6 
};

echo "Tema selezionato (applicato in questo momento): " . $_COOKIE["tema"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tema</title>
</head>
<body class="<?php echo $_COOKIE['tema']; ?>"> <!-- Assegno al body una classe con nome il tema scelto -->
    
    <form action="" method="GET">
        <input type="radio" name="tema" value="light"><span>Ligth mode</span>
        <br><input type="radio" name="tema" value="dark"><span>Dark mode</span>
        <br><button type="submit" name="btn_applica">Applica tema</button>
    </form>

    <style>
    body.dark {
        background-color: #222;
        color: white;
    }

    body.light {
        background-color: white;
        color: black;
    }
    </style>

</body>
</html>