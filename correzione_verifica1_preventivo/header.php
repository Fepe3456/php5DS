<h1>Benvenuto!</h1>
<h2>Il tuo preventivo ...</h2>
<?php

session_start(); 

if( isset($_SESSION['login']) ){
    $nomeLogin = $_SESSION['login']['nomeCliente']; 
    echo "<h3>Nome cliente: {$nomeLogin}</h3>";
};

?>