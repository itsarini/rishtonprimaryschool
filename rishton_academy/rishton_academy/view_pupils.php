<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
        include 'db_connection.php';

        // SQL query to join Pupils, Classes, and Parents
        $sql = "
            SELECT 
                Pupils.PupilID, 
                Pupils.Name AS PupilName, 
                Pupils.Address AS PupilAddress, 
                Pupils.MedicalInfo, 
                Classes.ClassName,
                p1.Name AS ParentOneName,
                p2.Name AS ParentTwoName
            FROM Pupils
            INNER JOIN Classes ON Pupils.ClassID = Classes.ClassID
            LEFT JOIN Parents p1 ON Pupils.ParentOneID = p1.ParentID
            LEFT JOIN Parents p2 ON Pupils.ParentTwoID = p2.ParentID
        ";

        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if (!$result) {
            die("Error executing query: " . mysqli_error($conn));
        }
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>View Pupils | Rishton Academy</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <h1>Pupils</h1>
            </header>
            <main>
                <button><a href="index.php" class="edit">Home</a></button>
                <button><a href="add_pupil.php" class="edit">Add Pupil</a></button>
                <button style="float: right;"> <a href="Logout.php" class="edit">Logout</a> </button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Medical Info</th>
                            <th>Class</th>
                            <th>Parent One</th>
                            <th>Parent Two</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo ($row['PupilID']); ?></td>
                            <td><?php echo ($row['PupilName']); ?></td>
                            <td><?php echo ($row['PupilAddress']); ?></td>
                            <td><?php echo ($row['MedicalInfo']); ?></td>
                            <td><?php echo ($row['ClassName']); ?></td>
                            <td><?php echo ($row['ParentOneName']) ?: 'No parent assigned'; ?></td>
                            <td><?php echo ($row['ParentTwoName']) ?: 'No parent assigned'; ?></td>
                            <td class="action-buttons">
                                <a href="edit_pupil.php?id=<?php echo ($row['PupilID']); ?>" class="edit">Edit</a>
                                <a href="delete_pupil.php?id=<?php echo ($row['PupilID']); ?>" class="delete">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </main>
        </body>
        </html>
    <?php
    }else{
        header("Location: login.php");
    }
?>