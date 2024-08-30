<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
        include 'db_connection.php';

        // Retrieve TeacherID from URL
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            echo "Invalid ID.";
            exit;
        }

        $teacherID = (int)$_GET['id'];

        // Fetch current teacher details
        $sql = "SELECT * FROM Teachers WHERE TeacherID = $teacherID";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            echo "Teacher not found.";
            exit;
        }

        $teacher = mysqli_fetch_assoc($result);

        // Retrieve classes for dropdown
        $sql = "SELECT ClassID, ClassName FROM Classes";
        $classesResult = mysqli_query($conn, $sql);

        // Fetching class data into an array
        $classes = [];
        while ($row = mysqli_fetch_assoc($classesResult)) {
            $classes[] = $row;
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
            $salary = (float)$_POST['salary'];
            $background_check = mysqli_real_escape_string($conn, $_POST['background_check']);
            $classID = (int)$_POST['classID'];

            // Check if classID is already assigned to another teacher
            $checkClassSql = "SELECT * FROM Teachers WHERE ClassID = $classID AND TeacherID != $teacherID";
            $checkClassResult = mysqli_query($conn, $checkClassSql);

            if (mysqli_num_rows($checkClassResult) > 0) {
                $error_message = "Class already assigned to another teacher.";
            } else {
                // Update teacher details if no conflict
                $sql = "
                    UPDATE Teachers
                    SET Name = '$name', Address = '$address', Phone = '$phone_number', Salary = $salary, BackgroundCheck = '$background_check', ClassID = $classID
                    WHERE TeacherID = $teacherID
                ";

                if (mysqli_query($conn, $sql)) {
                    header("Location: view_teachers.php");
                    exit;
                } else {
                    $error_message = "Error: " . mysqli_error($conn);
                }
            }

            mysqli_close($conn);
        }
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Teacher | Rishton Academy</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <h1>Edit Teacher</h1>
            </header>
            <main>
                <button><a href="index.php" class="edit">Home</a></button>
                <button style="float: right;"> <a href="Logout.php" class="edit">Logout</a> </button>
                <?php if (isset($error_message)) { ?>
                    <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
                <?php } ?>
                <form method="POST" action="edit_teacher.php?id=<?php echo $teacherID; ?>">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($teacher['Name']); ?>" required><br>
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($teacher['Address']); ?>" required><br>
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($teacher['Phone']); ?>" required><br>
                    <label for="salary">Salary:</label>
                    <input type="number" id="salary" name="salary" step="0.01" value="<?php echo htmlspecialchars($teacher['Salary']); ?>" required><br>
                    <label for="background_check">Background Check:</label>
                    <input type="text" id="background_check" name="background_check" value="<?php echo htmlspecialchars($teacher['BackgroundCheck']); ?>" required><br>
                    <label for="classID">Class:</label>
                    <select id="classID" name="classID" required>
                        <?php foreach ($classes as $class) { ?>
                            <option value="<?php echo $class['ClassID']; ?>" <?php if ($class['ClassID'] == $teacher['ClassID']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($class['ClassName']); ?>
                            </option>
                        <?php } ?>
                    </select><br>
                    <button type="submit">Update Teacher</button>
                </form>
            </main>
        </body>
        </html>
    <?php
    }else{
        header("Location: login.php");
    }
?>
