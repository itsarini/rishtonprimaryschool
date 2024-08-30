<?php
    session_start();
    // echo "<pre>";  print_r($_SESSION); echo "</pre>";
    if (isset($_SESSION['username']))
    {
        include 'db_connection.php';

        if (isset($_GET['id'])) {
            $pupilID = $_GET['id'];

            $sql = "DELETE FROM Pupils WHERE PupilID=$pupilID";

            if (mysqli_query($conn, $sql)) {
                header('Location: view_pupils.php');
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
        
    }else{
        header("Location: login.php");
    }
?>
