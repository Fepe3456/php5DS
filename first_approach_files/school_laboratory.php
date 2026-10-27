<?php

//Associative array 
$device = [
    "id" => "PC-01",
    "type" => "Desktop PC",
    "room" => "Lab 1",
    "status" => "open",
    "assignedTo" => "Sara"
];
//Add a new key 
$device["category"] = "hardware"; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School laboratory device</title>
</head>
<body>
    
    <?php  ?>
    <h1>School laboratory device</h1>


   <p><?php echo "ID: " . $device["id"]; ?></p>
   <p><?php echo "Type:" . $device["type"]; ?></p>
   <p>Room: <?php echo $device["room"]; ?></p>
   <p>Status: <?php echo $device["status"]; ?></p>
   <p><?php echo "Technician: {$device["assignedTo"]}"; ?></p>

   <hr><h2>print_r()</h2><?php print_r($device); ?>
   <hr><h2>var_dump()</h2><?php var_dump($device); ?>

</body>
</html>