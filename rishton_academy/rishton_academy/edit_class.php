<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
        include 'db_connection.php';

        if (isset($_GET['id'])) {
            $classID = $_GET['id'];
            $sql = "SELECT * FROM Classes WHERE ClassID = $classID";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $classID = $_POST['classID'];
            $className = $_POST['className'];
            $capacity = $_POST['capacity'];

            $sql = "UPDATE Classes SET ClassName='$className', Capacity=$capacity WHERE ClassID=$classID";

            if (mysqli_query($conn, $sql)) {
                header('Location: view_classes.php');
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
            <title>Edit Class | Rishton Academy</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <h1>Edit Class</h1>
            </header>
            <main>
                <button><a href="index.php" class="edit">Home</a></button>
                <button style="float: right;"> <a href="Logout.php" class="edit">Logout</a> </button>
                <form method="POST" action="edit_class.php">
                    <input type="hidden" name="classID" value="<?php echo $row['ClassID']; ?>">
                    <label for="className">Class Name:</label>
                    <input type="text" id="className" name="className" value="<?php echo $row['ClassName']; ?>" required><br>
                    <label for="capacity">Capacity:</label>
                    <input type="number" id="capacity" name="capacity" value="<?php echo $row['Capacity']; ?>" required><br>
                    <button type="submit">Update Class</button>
                </form>
            </main>
        </body>
        </html>
    <?php
    }else{
        header("Location: login.php");
    }
?>
