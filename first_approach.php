<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="" method="POST">
        <input type="text" name="inputcountry" placeholder="Enter the name of a Country">
        <button type="submit">INVIO</button>
    </form>

    <?php

        $capitals = array("USA" => "Washington D.C.",
                        "Japan" => "Kyoto",
                        "India" => "New Delhi"
        );
        if ($_SERVER["REQUEST_METHOD"] === "POST"){ //Se il form è stato inviato esegue il seguente blocco codice php 
            
            $key = $_POST["inputcountry"]; 

            if( isset($capitals[$key]) ){
                $ris = $capitals[$key]; 
                echo "<p>The capital of the country '$key' is <strong>$ris</strong></p>"; 
            }
            else{
                echo "<p>Country not found</p>"; 
            }
        }

    ?>

</body>
</html>