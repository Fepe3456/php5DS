<header>

<h1>Benvenuto!</h1>

<?php

session_start(); 

if( isset($_SESSION['login']) ){
    $nomeProgetto = $_SESSION['login']['nomeProgetto']; 
    echo "<h2>Il tuo preventivo --> {$nomeProgetto}</h2>"; 

    $nomeLogin = $_SESSION['login']['nomeCliente']; 
    echo "<h3>Nome cliente: {$nomeLogin}</h3>";
};

?>

</header>