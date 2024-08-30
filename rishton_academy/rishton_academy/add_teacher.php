<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
        include 'db_connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve and sanitize input
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
            $salary = (float)$_POST['salary'];
            $background_check = mysqli_real_escape_string($conn, $_POST['background_check']);
            $classID = (int)$_POST['classID'];

            // Check if classID is already assigned to another teacher
            $checkClassSql = "SELECT * FROM Teachers WHERE ClassID = $classID";
            $checkClassResult = mysqli_query($conn, $checkClassSql);

            if (mysqli_num_rows($checkClassResult) > 0) {
                $error_message = "Class already assigned to another teacher.";
                // die();
            } else {
                // Insert new teacher if no conflict
                $sql = "
                    INSERT INTO Teachers (Name, Address, Phone, Salary, BackgroundCheck, ClassID)
                    VALUES ('$name', '$address', '$phone_number', $salary, '$background_check', $classID)
                ";

                if (mysqli_query($conn, $sql)) {
                    header("Location: view_teachers.php");
                    exit(); // Ensure no further code runs after redirection
                } else {
                    $error_message = "Error: " . mysqli_error($conn);
                }
            }

            // mysqli_close($conn);
        }

        // Retrieve classes for dropdown
        $sql = "SELECT ClassID, ClassName FROM Classes";
        $classesResult = mysqli_query($conn, $sql);

        $classes = [];
        while ($row = mysqli_fetch_assoc($classesResult)) {
            $classes[] = $row;
        }
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Add Teacher | Rishton Academy</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <h1>Add New Teacher</h1>
            </header>
            <main>
                <button><a href="index.php" class="edit">Home</a></button>
                <button style="float: right;"> <a href="Logout.php" class="edit">Logout</a> </button>
                <?php if (isset($error_message)) { ?>
                    <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
                <?php } ?>
                <form method="POST" action="add_teacher.php">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required><br>
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required><br>
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" required><br>
                    <label for="salary">Annual Salary:</label>
                    <input type="number" id="salary" name="salary" step="0.01" required><br>
                    <label for="background_check">Background Check:</label>
                    <input type="text" id="background_check" name="background_check" required><br>
                    <label for="classID">Class:</label>
                    <select id="classID" name="classID" required>
                        <option value="" disabled selected>Select a class</option>
                        <?php foreach ($classes as $class) { ?>
                            <option value="<?php echo $class['ClassID']; ?>"><?php echo htmlspecialchars($class['ClassName']); ?></option>
                        <?php } ?>
                    </select><br>
                    <button type="submit">Add Teacher</button>
                </form>
            </main>
        </body>
        </html>
    <?php
    }else{
        header("Location: login.php");
    }
?>
