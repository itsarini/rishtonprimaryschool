<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
        include 'db_connection.php';

        // Check if the book ID is provided in the URL
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $bookID = (int)$_GET['id'];

            // Fetch the current book details
            $sql = "SELECT * FROM LibraryBooks WHERE BookID = $bookID";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
            } else {
                echo "Book not found.";
                exit;
            }
        } else {
            echo "Invalid book ID.";
            exit;
        }

        // Handle form submission for updating the book details
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $bookID = (int)$_POST['bookID'];
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $author = mysqli_real_escape_string($conn, $_POST['author']);
            $available_copy = (int)$_POST['available_copy'];
            $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);

            // Update the book details in the database
            $sql = "UPDATE LibraryBooks 
                    SET Title='$title', Author='$author', Available_Copies=$available_copy, ISBN='$isbn' 
                    WHERE BookID=$bookID";

            if (mysqli_query($conn, $sql)) {
                header('Location: view_books.php');
                exit;
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Book | Rishton Academy</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <h1>Edit Book</h1>
            </header>
            <main>
                <button><a href="index.php" class="edit">Home</a></button>
                <button style="float: right;"> <a href="Logout.php" class="edit">Logout</a> </button>
                <form method="POST" action="edit_book.php?id=<?php echo $bookID; ?>">
                    <input type="hidden" name="bookID" value="<?php echo $row['BookID']; ?>">
                    
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($row['Title']); ?>" required><br>
                    
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($row['Author']); ?>" required><br>
                    
                    <label for="available_copy">Available Copies:</label>
                    <input type="number" id="available_copy" name="available_copy" value="<?php echo htmlspecialchars($row['Available_Copies']); ?>" required><br>
                    
                    <label for="isbn">ISBN:</label>
                    <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($row['ISBN']); ?>" required><br>
                    
                    <button type="submit">Update Book</button>
                </form>
            </main>
        </body>
        </html>
    <?php
    }else{
        header("Location: login.php");
    }
?>