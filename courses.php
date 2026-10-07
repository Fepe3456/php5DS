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
</head>
<body>

    <h1>Tech Courses Portal</h1>

    <!--
    <?php
    printArrayBidimensional($courses); 
    ?>
    -->
    
    <p>Select the category: </p>
    <form action="" method="POST">

        <select name="category_select" id="category_select">
            <option value="all">All</option>
            <option value="programming">Programming</option>
            <option value="cybersecurity">Cybersecurity</option>
            <option value="data science">Data science</option>
        </select>
        <button type="submit">ENTER</button>

        <?php
        
        if( $_SERVER["REQUEST_METHOD"] === "POST" ){

            $key = $_POST["category_select"]; 
            echo "<p>The selected category is {$key}</p>";

            if( strtolower($key) === "all" ){
                $filtered_courses = $courses; 
            }
            else{
                foreach($courses as $course){
                    if( strtolower($course["category"]) === strtolower($key) ){
                        $filtered_courses[] = $course; 
                    }
                }
            }

            printArrayBidimensional($filtered_courses); 
        }
        
        ?>

    </form>

    <br><br><br><br>
    
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

    <br><br><br><br>

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
            echo calculateTotalHours($filtered_courses, "programming"); 
        ?>
    </h3>

</body>
</html>
