<?php
    $courses = [
        [
        "title" => "Introduction to Python",
        "category" => "Programming",
        "level" => "Beginner",
        "duration" => 10
        ],
        [
        "title" => "Web Development with PHP",
        "category" => "Programming",
        "level" => "Intermediate",
        "duration" => 15
        ],
        [
        "title" => "Network Security",
        "category" => "Cybersecurity",
        "level" => "Intermediate",
        "duration" => 12
        ],
        [
        "title" => "Ethical Hacking",
        "category" => "Cybersecurity",
        "level" => "Advanced",
        "duration" => 16
        ],
        [
        "title" => "Data Analysis with Python",
        "category" => "Data Science",
        "level" => "Intermediate",
        "duration" => 14
        ]
    ];

    $filtered_courses = []; 

    $key = "all"; //Inizializzo la variabile che conterrà il valore della categoria selezionata
?>

<?php

function printArrayBidimensional($array){
    foreach($array as $index => $element){
        echo "<br>Element {$index}:     ";
        foreach($element as $key => $value){
            echo "{$key} => {$value}<br>"; 
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Courses Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Tech Courses Portal</h1>

    <!--
    <?php
    printArrayBidimensional($courses); 
    ?>
    -->

    <div id="container" class="container">
    
        <div id="div_category" class="part_ex">
            <p>Select the category: </p>
            <form action="" method="GET">

                <select name="category_select" id="category_select">
                    <option value="all">All</option>
                    <option value="programming">Programming</option>
                    <option value="cybersecurity">Cybersecurity</option>
                    <option value="data science">Data science</option>
                </select>
                <button type="submit">ENTER</button>

                <?php
                
                if( $_SERVER["REQUEST_METHOD"] === "GET" ){

                    $key = $_GET["category_select"] ?? "all"; //Assegno a key il valore della categoria selezionata 
                    // ?? "all" mette il valore all per la prima volta (vedi meglio sintassi a riga 124)
                    echo "<p>The selected category is {$key}</p>"; //Stampo per verificare che legga correttamente quanto inserito

                    if( strtolower($key) === "all" ){ //Se è stato selezionato 'all' i corsi filtrati rimangono gli stessi dell'array courses 
                        $filtered_courses = $courses; 
                    }
                    else{ //Altrimenti per ogni corso nell'array courses cerco quale corso ha la categoria uguale a quella selezionata 
                        foreach($courses as $course){
                            if( strtolower($course["category"]) === strtolower($key) ){ //se è così aggiungo il corso nell'arrat filtered_courses 
                                $filtered_courses[] = $course; 
                            }
                        }
                    }

                    printArrayBidimensional($filtered_courses); 
                }
                
                ?>

            </form>
        </div>
        
        <div id="div_partecipation" class="part_ex">
            <form action="" method="POST">
                <input type="text" name="name" placeholder="Name">
                <input type="text" name="email" placeholder="E-mail">
                <select name="availableCourses" id="availableCourses">
                    <?php
                        foreach($filtered_courses as $course){
                            echo "<option>{$course["title"]}</option>"; 
                        }
                    ?>
                </select>
                <input type="text" name="motivation" placeholder="Motivation">
                <button type="submit">SUBMIT</button>

                <?php
                    if( $_SERVER["REQUEST_METHOD"] === "POST" ){
                        $name = $_POST["name"] ?? ""; // ?? "" serve per evitare di visualizzare il messaggio d'errore prima che il form venga inviato
                        $email = $_POST["email"] ?? "";
                        $course = $_POST["availableCourses"] ?? "";
                        $motivation = $_POST["motivation"] ?? ""; 
                        if( !empty($name) && !empty($email) && !empty($course) && !empty($motivation) ){
                            echo "Participation request received!<br>
                            Student: {$name}<br>
                            Email: {$email}<br>
                            Course: {$course}<br>
                            Motivation: {$motivation}<br>";
                        }
                    }
                ?>
            </form>
        </div>

        <div id="div_total" class="part_ex">
            <h3>Total hours: 
                <?php
                    function calculateTotalHours($array, $category){
                        $total = 0; 
                        foreach($array as $element){
                            if( strtolower($category) === "all" || strtolower($element["category"]) === strtolower($category) ){
                                $total += $element["duration"]; 
                            }
                        }
                        return $total; 
                    }
                    echo calculateTotalHours($filtered_courses, $key); 
                ?>
            </h3>
        </div>

    </div>

</body>
</html>
