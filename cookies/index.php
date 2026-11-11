<?php


//Controllo se è settato
if( isset( $_COOKIE["visite"] ) ){
    $visite = $_COOKIE["visite"] + 1;
}
else{
    $visite = 1;
}


//        nome      valore    persistenza      cookie va tamesso solo in https    non accessibile tramite codice js
setcookie("visite", $visite, time() + 60*60*24, true                            , true                               ); //86400ms = 1giorno


echo $_COOKIE["visite"];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
    <p>Hai visitato questo sito: <?php echo $_COOKIE["visite"];?> volte</p>


</body>
</html>
