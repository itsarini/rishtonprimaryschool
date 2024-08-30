<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
        include 'db_connection.php';

        // Check if ID is provided
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            die("Invalid Pupil ID");
        }

        $pupilID = (int)$_GET['id'];

        // Fetch current pupil details
        $sql = "
            SELECT 
                Pupils.PupilID, 
                Pupils.Name AS PupilName, 
                Pupils.Address AS PupilAddress, 
                Pupils.MedicalInfo, 
                Pupils.ClassID, 
                Pupils.ParentOneID, 
                Pupils.ParentTwoID,
                Classes.ClassName
            FROM Pupils
            INNER JOIN Classes ON Pupils.ClassID = Classes.ClassID
            WHERE Pupils.PupilID = $pupilID
        ";

        $pupilResult = mysqli_query($conn, $sql);

        // Check if the pupil exists
        if (mysqli_num_rows($pupilResult) == 0) {
            die("Pupil not found");
        }

        $pupil = mysqli_fetch_assoc($pupilResult);

        // Fetch all classes
        $classesSql = "SELECT ClassID, ClassName FROM Classes";
        $classesResult = mysqli_query($conn, $classesSql);
        $classes = [];
        while ($row = mysqli_fetch_assoc($classesResult)) {
            $classes[] = $row;
        }

        // Fetch all parents
        $parentsSql = "SELECT ParentID, Name FROM Parents";
        $parentsResult = mysqli_query($conn, $parentsSql);
        $parents = [];
        while ($row = mysqli_fetch_assoc($parentsResult)) {
            $parents[] = $row;
        }

        // Update pupil information
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $medical_info = mysqli_real_escape_string($conn, $_POST['medical_info']);
            $classID = (int)$_POST['classID']; // Cast to integer
            $parentOneID = isset($_POST['parent_one']) ? (int)$_POST['parent_one'] : 'NULL';
            $parentTwoID = isset($_POST['parent_two']) ? (int)$_POST['parent_two'] : 'NULL';

            $updateSql = "
                UPDATE Pupils
                SET 
                    Name = '$name',
                    Address = '$address',
                    MedicalInfo = '$medical_info',
                    ClassID = $classID,
                    ParentOneID = $parentOneID,
                    ParentTwoID = $parentTwoID
                WHERE PupilID = $pupilID
            ";

            if (mysqli_query($conn, $updateSql)) {
                header("Location: view_pupils.php");
                exit(); // Ensure no further code runs after redirection
            } else {
                echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
            }
        }

        mysqli_close($conn);
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Pupil | Rishton Academy</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <h1>Edit Pupil</h1>
            </header>
            <main>
                <button><a href="index.php" class="edit">Home</a></button>
                <button style="float: right;"> <a href="Logout.php" class="edit">Logout</a> </button>
                <form method="POST" action="edit_pupil.php?id=<?php echo urlencode($pupilID); ?>">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($pupil['PupilName']); ?>" required><br>
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($pupil['PupilAddress']); ?>" required><br>
                    <label for="medical_info">Medical Information:</label>
                    <textarea id="medical_info" name="medical_info"><?php echo htmlspecialchars($pupil['MedicalInfo']); ?></textarea><br>
                    <label for="classID">Class:</label>
                    <select id="classID" name="classID" required>
                        <?php foreach ($classes as $class) { ?>
                            <option value="<?php echo $class['ClassID']; ?>" <?php echo $pupil['ClassID'] == $class['ClassID'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($class['ClassName']); ?>
                            </option>
                        <?php } ?>
                    </select><br>
                    <label for="parent_one">Parent One:</label>
                    <select id="parent_one" name="parent_one">
                        <option value="">Select a parent</option>
                        <?php foreach ($parents as $parent) { ?>
                            <option value="<?php echo $parent['ParentID']; ?>" <?php echo $pupil['ParentOneID'] == $parent['ParentID'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($parent['Name']); ?>
                            </option>
                        <?php } ?>
                    </select><br>
                    <label for="parent_two">Parent Two:</label>
                    <select id="parent_two" name="parent_two">
                        <option value="">Select a parent</option>
                        <?php foreach ($parents as $parent) { ?>
                            <option value="<?php echo $parent['ParentID']; ?>" <?php echo $pupil['ParentTwoID'] == $parent['ParentID'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($parent['Name']); ?>
                            </option>
                        <?php } ?>
                    </select><br>
                    <button type="submit">Update Pupil</button>
                </form>
            </main>
        </body>
        </html>
    <?php
    }else{
        header("Location: login.php");
    }
?>
