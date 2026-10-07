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
?>

<?php

function printArray($array){
    foreach($array as $key => $value){
        echo "{$key} => {$value}<br>"; 
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
    
    <p>Select the category: </p>
    <form action="" method="POST">

        <select name="category_select" id="category_select">
            <option value="all">All</option>
            <option value="programming">Programming</option>
            <option value="cybersecurity">Cybersecurity</option>
            <option value="data_science">Data science</option>
        </select>
        <button type="submit">ENTER</button>

        <?php
        /*read the selected category in PHP; 
use a foreach loop to examine $courses;
display only the matching courses;
display all courses if All is selected. */

        if( $_SERVER["REQUEST_METHOD"] === "POST" ){

            $key = $_POST["category_select"]; 
            echo "<p>The selected category is {$key}</p>";
            
            $filtered_courses = []; 
            foreach($courses as $course){
                foreach($course){
                    if( $course["category"] === $key ){
                        $filtered_courses.push($course); 
                    }
                }
            }

            printArray($filtered_courses); 
        }
        
        ?>

    </form>

</body>
</html>
