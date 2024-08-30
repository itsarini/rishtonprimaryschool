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
            $medical_info = mysqli_real_escape_string($conn, $_POST['medical_info']);
            $classID = (int)$_POST['classID']; // Cast to integer
            $parentOneID = (int)$_POST['parent_one']; // Cast to integer
            $parentTwoID = (int)$_POST['parent_two']; // Cast to integer

            // Insert pupil
            $sql = "INSERT INTO Pupils (Name, Address, MedicalInfo, ClassID, ParentOneID, ParentTwoID) 
                    VALUES ('$name', '$address', '$medical_info', $classID, $parentOneID, $parentTwoID)";

            if (mysqli_query($conn, $sql)) {
                header("Location: view_pupils.php");
                exit(); // Ensure no further code runs after redirection
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            // mysqli_close($conn);
        }

        // Retrieve classes for dropdown
        $sql = "SELECT ClassID, ClassName FROM Classes";
        $classesResult = mysqli_query($conn, $sql);

        // Fetching class data into an array
        $classes = [];
        while ($row = mysqli_fetch_assoc($classesResult)) {
            $classes[] = $row;
        }

        // Retrieve parents for dropdown
        $sql = "SELECT ParentID, Name FROM Parents";
        $parentsResult = mysqli_query($conn, $sql);

        // Fetching parent data into an array
        $parents = [];
        while ($row = mysqli_fetch_assoc($parentsResult)) {
            $parents[] = $row;
        }
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Add Pupil | Rishton Academy</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <h1>Add New Pupil</h1>
            </header>
            <main>
                <button><a href="index.php" class="edit">Home</a></button>
                <button style="float: right;"> <a href="Logout.php" class="edit">Logout</a> </button>
                <form method="POST" action="add_pupil.php">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required><br>
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required><br>
                    <label for="medical_info">Medical Information:</label>
                    <textarea id="medical_info" name="medical_info"></textarea><br>
                    <label for="classID">Class:</label>
                    <select id="classID" name="classID" required>
                        <option value="" disabled selected>Select a class</option>
                        <?php foreach ($classes as $class) { ?>
                            <option value="<?php echo $class['ClassID']; ?>"><?php echo htmlspecialchars($class['ClassName']); ?></option>
                        <?php } ?>
                    </select><br>
                    <label for="parent_one">Parent One:</label>
                    <select id="parent_one" name="parent_one" required>
                        <option value="" disabled selected>Select Parent One</option>
                        <?php foreach ($parents as $parent) { ?>
                            <option value="<?php echo $parent['ParentID']; ?>"><?php echo htmlspecialchars($parent['Name']); ?></option>
                        <?php } ?>
                    </select><br>
                    <label for="parent_two">Parent Two:</label>
                    <select id="parent_two" name="parent_two" required>
                        <option value="" disabled selected>Select Parent Two</option>
                        <?php foreach ($parents as $parent) { ?>
                            <option value="<?php echo $parent['ParentID']; ?>"><?php echo htmlspecialchars($parent['Name']); ?></option>
                        <?php } ?>
                    </select><br>
                    <button type="submit">Add Pupil</button>
                </form>
            </main>
        </body>
        </html>
    <?php
    }else{
        header("Location: login.php");
    }
?>
