<?php
	include("db_connection.php");


	if (isset($_POST['Login']))
	{
		// echo "<pre>";  print_r($_POST); echo "</pre>";
		
		$username = $_POST['username'];
		$password = MD5($_POST['password']);
		// echo $password."<br>";

		if (isset($username) && isset($password))
		{
			$sql = "SELECT * FROM users WHERE email = '$username' AND  pass = '$password' AND status ='1'";
			// echo $sql;
			// die();
			$query_run = mysqli_query($conn, $sql);
			// echo "<pre>";  print_r($query_run); echo "</pre>";

			if (mysqli_num_rows($query_run) > 0)
			{
				session_start();
				while($row = mysqli_fetch_assoc($query_run))
				{
				  $_SESSION['username'] = $row['name'];
				  $_SESSION['email'] = $row['email'];
				  header("location:index.php");
				}
			}else{
			header("location:login.php?error=Incorect User name or password");
			}
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .login-container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="Login" value="Login">
            </div>
            <?php
            if (isset($_GET['error'])) {
                echo '<div class="error">' . htmlspecialchars($_GET['error']) . '</div>';
            }
            ?>
        </form>
    </div>
</body>
</html>