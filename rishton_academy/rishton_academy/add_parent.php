<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
        include 'db_connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firstName = $_POST['first_name'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phone_number'];
            $address = $_POST['address'];
            $pupilID = $_POST['pupil_id'];

            $sql = "INSERT INTO Parents (Name, Address, Email, Phone) VALUES ('$firstName',  '$address' ,'$email', '$phoneNumber')";

            if (mysqli_query($conn, $sql)) {
                header('Location: view_parents.php');
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Add Parent | Rishton Academy</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <h1>Add New Parent</h1>
            </header>
            <main>
                <button><a href="index.php" class="edit">Home</a></button>
                <button style="float: right;"> <a href="Logout.php" class="edit">Logout</a> </button>
                <form method="POST" action="add_parent.php">
                    <label for="first_name">Name:</label>
                    <input type="text" id="first_name" name="first_name" required><br>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br>
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" required><br>
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required><br>
                    <button type="submit">Add Parent</button>
                </form>
            </main>
        </body>
        </html>
    <?php
    }else{
        header("Location: login.php");
    }
?>