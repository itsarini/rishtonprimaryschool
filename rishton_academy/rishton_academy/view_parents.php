<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
        include 'db_connection.php';

        // Fetch all parents and their associated pupils
        $sql = "
            SELECT 
                p.ParentID, 
                p.Name AS ParentName, 
                p.Email, 
                p.Phone, 
                p.Address,
                GROUP_CONCAT(DISTINCT pu.Name ORDER BY pu.Name ASC SEPARATOR ', ') AS Pupils
            FROM 
                Parents p
            LEFT JOIN 
                Pupils pu ON pu.ParentOneID = p.ParentID OR pu.ParentTwoID = p.ParentID
            GROUP BY 
                p.ParentID, p.Name, p.Email, p.Phone, p.Address
        ";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Error executing query: " . mysqli_error($conn));
        }

        mysqli_close($conn);
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>View Parents | Rishton Academy</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <h1>Parents</h1>
            </header>
            <main>
                <button><a href="index.php" class="edit">Home</a></button>
                <button><a href="add_parent.php" class="edit">Add Parent</a></button>
                <button style="float: right;"> <a href="Logout.php" class="edit">Logout</a> </button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Pupils</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['ParentID']; ?></td>
                            <td><?php echo htmlspecialchars($row['ParentName']); ?></td>
                            <td><?php echo htmlspecialchars($row['Email']); ?></td>
                            <td><?php echo htmlspecialchars($row['Phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['Address']); ?></td>
                            <td><?php echo htmlspecialchars($row['Pupils']) ?: 'No pupils assigned'; ?></td>
                            <td class="action-buttons">
                                <a href="edit_parent.php?id=<?php echo $row['ParentID']; ?>" class="edit">Edit</a>
                                <a href="delete_parent.php?id=<?php echo $row['ParentID']; ?>" class="delete">Delete</a>
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
