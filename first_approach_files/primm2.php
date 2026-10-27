<!--

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRIMM 2</title>
</head>
<body>
    
    <?php
    /* 
    $ticket = [
    "id" => "LAB-24",
    "device" => "PC-12",
    "room" => "Lab 3",
    "priority" => 2,
    "status" => "open"
    ];

    $technician = "Sara";

    echo "Ticket: " . $ticket["id"] . "<br>";
    echo "Device: " . $ticket["device"] . "<br>";
    echo "Room: {$ticket["room"]}<br>";
    echo "Assigned to: $technician<br><br>";

    print_r($ticket);

    echo "<br><br>";
    var_dump($ticket);



    echo "<br><br><br>AGGIUNTA 'category' => 'hardware'<br>print_r():     ";
    $ticket["category"] = "hardware";
    print_r($ticket);
    echo "<br><br>var_dump():     ";
    var_dump($ticket);



    $message = "Ticket " . $ticket["id"] . " is assigned to " . $technician . ".";
    echo "<br><br><br>Concatenation message: $message"; 
    echo "<br>Ticket ${ticket["id"]} is assigned to $technician."; 
    echo '<br>Assigned to: $technician<br>';

    */
    ?>

</body>
</html>

--> 


<?php
$ticket = [
   "id" => "LAB-24",
   "device" => "PC-12",
   "room" => "Lab 3",
   "status" => "open",
   "technician" => "Sara"
];

$ticket2 = [
   "id" => "LAB-20",
   "device" => "PC-10",
   "room" => "Lab 4",
   "status" => "closed",
   "technician" => "Mario"
];


$tickets = [
    [
        "id" => "LAB-1",
        "device" => "PC-1",
        "room" => "Lab 1",
        "status" => "closed",
        "technician" => "Sara"
    ],
    [
        "id" => "LAB-2",
        "device" => "PC-2",
        "room" => "Lab 2",
        "status" => "open",
        "technician" => "Mario"
    ]
]; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Support Ticket</title>
</head>
<body>


   <h1>IT Support Ticket <?php echo "Ticket: " . $ticket["id"]; ?></h1>


   <p>Ticket ID: <?php echo "Ticket: " . $ticket["id"]; ?></p>
   <p>Device: <?php echo $ticket["device"]; ?></p>
   <p>Room: <?php echo $ticket["room"]; ?></p>
   <p>Status: <?php echo $ticket["status"]; ?></p>
   <p>Technician: <?php echo $ticket["technician"]; ?></p>

   <br><br>
   <p>Device 2: <?php echo $ticket2["device"]; ?></p>
   <p>Room 2: <?php echo $ticket2["room"]; ?></p>

   <hr><?php print_r($ticket); ?>
   <hr><?php var_dump($ticket); ?>

   <hr><hr>
   <p>Device [0]: <?php echo $tickets[0]["device"]; ?></p>
   <p>Room [0]: <?php echo $tickets[0]["room"]; ?></p>
   <p>Device [1]: <?php echo $tickets[1]["device"]; ?></p>
   <p>Room [1]: <?php echo $tickets[1]["room"]; ?></p>


</body>
</html>
