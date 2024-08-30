<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
    ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Rishton Academy</title>
                <link rel="stylesheet" href="styles.css">
            </head>
            <body>
                <header>
                    <h1>Rishton Academy</h1>
                </header>
                <main>
                    <button style="margin-left: 65%;"><a href="logout.php">logout</a></button>
                    <nav>
                        <ul>
                            <li><a href="add_class.php">Add Class</a></li>
                            <li><a href="view_classes.php">View Classes</a></li>
                            <li><a href="add_parent.php">Add Parent</a></li>
                            <li><a href="view_parents.php">View Parent</a></li>
                            <li><a href="add_pupil.php">Add Pupil</a></li>
                            <li><a href="view_pupils.php">View Pupils</a></li>
                            <li><a href="add_teacher.php">Add Teacher</a></li>
                            <li><a href="view_teachers.php">View Teachers</a></li>
                            <li><a href="add_book.php">Add Book</a></li>
                            <li><a href="view_books.php">View Library Books</a></li>
                        </ul>
                    </nav>
                </main>
            </body>
        </html>
    <?php
    }else{
        header("Location: login.php");
    }
?>
