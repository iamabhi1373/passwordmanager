<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "password_manager";

    $conn = new mysqli($server, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection to database failed due to " . $conn->connect_error);
    }

    $user = $_POST['Usrname'];
    $password = $_POST['Password'];

    // Directly check for provided username and password in the database
    $sql = "SELECT * FROM authentication WHERE email = '$user' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['Username'] = $user;
        header("Location: ../Login/tempo.php");
        exit();
    } else {
        echo "<h2 style='text-align: center'>User not found or incorrect credentials</h2>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <form action="tempo.php" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="Usrname" id="Usrname" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="Password" id="Password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="../Register/index.php">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>
