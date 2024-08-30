<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
        include 'db_connection.php';

        // SQL query to join Teachers with Classes to get the class name
        $sql = "
            SELECT t.teacherID, t.Name, t.Address, t.Phone, t.Salary, t.BackgroundCheck, c.ClassName
            FROM teachers t
            JOIN Classes c ON t.ClassID = c.ClassID
        ";
        $result = mysqli_query($conn, $sql);
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>View Teachers | Rishton Academy</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <h1>Teachers</h1>
            </header>
            <main>
                <button> <a href="index.php" class="edit">Home</a> </button>
                <button> <a href="add_teacher.php" class="edit">Add Teacher</a> </button>
                <button style="float: right;"> <a href="Logout.php" class="edit">Logout</a> </button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Salary</th>
                            <th>Background Check</th>
                            <th>Class</th> <!-- Updated header -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['teacherID']; ?></td>
                            <td><?php echo ($row['Name']); ?></td>
                            <td><?php echo ($row['Address']); ?></td>
                            <td><?php echo ($row['Phone']); ?></td>
                            <td><?php echo ($row['Salary']); ?></td>
                            <td><?php echo ($row['BackgroundCheck']); ?></td>
                            <td><?php echo ($row['ClassName']); ?></td> <!-- Updated data -->
                            <td class="action-buttons">
                                <a href="edit_teacher.php?id=<?php echo $row['teacherID']; ?>" class="edit">Edit</a>
                                <a href="delete_teacher.php?id=<?php echo $row['teacherID']; ?>" class="delete">Delete</a>
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