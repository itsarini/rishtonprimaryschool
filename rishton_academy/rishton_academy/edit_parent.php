<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
        include 'db_connection.php';

        // Fetch the parent details based on ParentID
        if (isset($_GET['id'])) {
            $parentID = $_GET['id'];
            $sql = "SELECT * FROM Parents WHERE ParentID = $parentID";
            $result = mysqli_query($conn, $sql);
            
            // Check if the query was successful and if a record was found
            if (!$result) {
                die("Error executing query: " . mysqli_error($conn));
            }
            
            $parent = mysqli_fetch_assoc($result);

            if (!$parent) {
                die("Parent not found.");
            }
        } else {
            die("Invalid ID.");
        }

        // Update the parent details in the database
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firstName = $_POST['first_name'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phone_number'];
            $address = $_POST['address'];
            
            $sql = "UPDATE Parents SET Name='$firstName', Email='$email', Phone='$phoneNumber', Address='$address' WHERE ParentID=$parentID";

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
            <title>Edit Parent | Rishton Academy</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <h1>Edit Parent</h1>
            </header>
            <main>
                <button><a href="index.php" class="edit">Home</a></button>
                <button style="float: right;"> <a href="Logout.php" class="edit">Logout</a> </button>
                <form method="POST" action="edit_parent.php?id=<?php echo $parentID; ?>">
                    <label for="first_name">Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($parent['Name']); ?>" required><br>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($parent['Email']); ?>" required><br>
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($parent['Phone']); ?>" required><br>
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($parent['Address']); ?>" required><br>
                    <button type="submit">Update Parent</button>
                </form>
            </main>
        </body>
        </html>
    <?php
    }else{
        header("Location: login.php");
    }
?>
