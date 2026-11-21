<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <?php include "header.php"; ?>

    <div class="form-container">

        <form action="index.php" method="GET">
            <div class="form-group">
                <label for="">Nome cliente: </label>
                <input type="text" name="nomeClienteLogin">
            </div>
            <br>
            <input type="submit" value="ENTER">
        </form>

    </div>
    
    <?php include "footer.php"; ?>

</body>
</html>

