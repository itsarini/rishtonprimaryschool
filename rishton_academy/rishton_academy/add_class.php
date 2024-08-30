<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
        // add_class.php
        include 'db_connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $className = $_POST['className'];
            $capacity = $_POST['capacity'];

            $sql = "INSERT INTO Classes (ClassName, Capacity) VALUES ('$className', $capacity)";

            if (mysqli_query($conn, $sql)) {
                // echo "New class added successfully";
                header("Location: view_classes.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Add Class | Rishton Academy</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <h1>Add New Class</h1>
            </header>
            <main>
                <button><a href="index.php" class="edit">Home</a></button>
                <button style="float: right;"> <a href="Logout.php" class="edit">Logout</a> </button>
                <form method="POST" action="add_class.php">
                    <label for="className">Class Name:</label>
                    <input type="text" id="className" name="className" required><br>
                    <label for="capacity">Capacity:</label>
                    <input type="number" id="capacity" name="capacity" required><br>
                    <button type="submit">Add Class</button>
                </form>
            </main>
        </body>
        </html>
    <?php
    }else{
        header("Location: login.php");
    }
?>
