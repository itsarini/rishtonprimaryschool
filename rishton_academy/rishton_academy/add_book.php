<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
        include 'db_connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $author = mysqli_real_escape_string($conn, $_POST['author']);
            $available_copy = (int)$_POST['available_copy'];
            $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);

            $sql = "INSERT INTO LibraryBooks (Title, Author, Available_Copies, ISBN)
                    VALUES ('$title', '$author', $available_copy, '$isbn')";

            if (mysqli_query($conn, $sql)) {
                // Redirect to a page that lists the books after successful insertion
                header("Location: view_books.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Add Book | Rishton Academy</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <header>
                <h1>Add New Book</h1>
            </header>
            <main>
                <button><a href="index.php" class="edit">Home</a></button>
                <button style="float: right;"> <a href="Logout.php" class="edit">Logout</a> </button>
                <form method="POST" action="add_book.php">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required><br>

                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" required><br>

                    <label for="isbn">ISBN:</label>
                    <input type="text" id="isbn" name="isbn" required><br>

                    <label for="available_copy">Available Copies:</label>
                    <input type="number" id="available_copy" name="available_copy" required><br>

                    <button type="submit">Add Book</button>
                </form>
            </main>
        </body>
        </html>
    <?php
    }else{
        header("Location: login.php");
    }
?>

