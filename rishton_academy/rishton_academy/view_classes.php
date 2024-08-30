<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
        include 'db_connection.php';

        // Fetch classes with their respective pupils and teachers
        $sql = "
           SELECT 
                c.ClassID, 
                c.ClassName, 
                c.Capacity, 
                GROUP_CONCAT(DISTINCT p.Name ORDER BY p.Name ASC SEPARATOR ', ') AS Pupils, 
                GROUP_CONCAT(DISTINCT t.Name ORDER BY t.Name ASC SEPARATOR ', ') AS Teachers
            FROM 
                Classes c
            LEFT JOIN 
                Pupils p ON c.ClassID = p.ClassID
            LEFT JOIN 
                Teachers t ON c.ClassID = t.ClassID
            GROUP BY 
                c.ClassID, c.ClassName, c.Capacity
            ORDER BY 
                c.ClassID
        ";

        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if (!$result) {
            die("Error executing query: " . mysqli_error($conn));
        }

        // Prepare an associative array to store classes and their pupils and teachers
        $classes = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $classID = $row['ClassID'];
            $classes[$classID] = [
                'ClassName' => $row['ClassName'],
                'Capacity' => $row['Capacity'],
                'Pupils' => $row['Pupils'],
                'Teachers' => $row['Teachers'],
            ];
        }

        mysqli_close($conn);
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>View Classes | Rishton Academy</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <h1>Classes</h1>
            </header>
            <main>
                <button><a href="index.php" class="edit">Home</a></button>
                <button><a href="add_class.php" class="edit">Add Class</a></button>
                <button style="float: right;"> <a href="Logout.php" class="edit">Logout</a> </button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Class Name</th>
                            <th>Capacity</th>
                            <th>Pupils</th>
                            <th>Teachers</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($classes as $classID => $class) { ?>
                        <tr>
                            <td><?php echo $classID; ?></td>
                            <td><?php echo htmlspecialchars($class['ClassName']); ?></td>
                            <td><?php echo $class['Capacity']; ?></td>
                            <td>
                                <?php echo htmlspecialchars($class['Pupils']) ?: 'No pupils assigned'; ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($class['Teachers']) ?: 'No teachers assigned'; ?>
                            </td>
                            <td class="action-buttons">
                                <a href="edit_class.php?id=<?php echo $classID; ?>" class="edit">Edit</a>
                                <a href="delete_class.php?id=<?php echo $classID; ?>" class="delete">Delete</a>
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
