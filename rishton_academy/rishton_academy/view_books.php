<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
        include 'db_connection.php';
        $sql = "SELECT * FROM LibraryBooks";
        $result = mysqli_query($conn, $sql);
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>View Books | Rishton Academy</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <h1>Library Books</h1>
            </header>
            <main>
                 <button> <a href="index.php" class="edit">Home</a> </button>
                 <button> <a href="add_book.php" class="edit">Add Book</a> </button>
                 <button style="float: right;"> <a href="Logout.php" class="edit">Logout</a> </button>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Available Copies</th>
                            <th>ISBN</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['BookID']; ?></td>
                            <td><?php echo $row['Title']; ?></td>
                            <td><?php echo $row['Author']; ?></td>
                            <td><?php echo $row['Available_Copies']; ?></td>
                            <td><?php echo $row['ISBN']; ?></td>
                            <td class="action-buttons">
                                <a href="edit_book.php?id=<?php echo $row['BookID']; ?>" class="edit">Edit</a>
                                <a href="delete_book.php?id=<?php echo $row['BookID']; ?>" class="delete">Delete</a>
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