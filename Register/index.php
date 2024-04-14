<?php
session_start();
$submit = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = "localhost";
    $username = "root";
    $pass = "";
    $dbname = "password_manager";

    $conn = new mysqli($server, $username, $pass, $dbname);
    
    if ($conn->connect_error) {
        die("Connection to database failed due to " . $conn->connect_error);
    }

    $email = $_POST['Email'];
    $password = $_POST['Password'];
    
    $sql = "INSERT INTO `password_manager`.`Authentication`(Email, Password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    
    if ($stmt->execute()) {
        $submit = true;
        // Redirect to login page after successful registration
        header("Location: ../Login/indexL.php");
        exit(); // Make sure to stop the script execution after redirection
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <form action="" method="post"> <!-- Set the action to the current file -->
            <h1>Register</h1>
            <?php
            if($submit==true){
                echo "<h2 style='text-align: center;'>Account created!</h2>";
            }
            ?>
            <div class="input-box">
                <input type="email" name="Email" id="Email" placeholder="Email (Username)" required>
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="input-box">
                <input type="password" name="Password" id="Password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <button type="submit" class="btn">Register</button>
            <div class="register-link">
                <p>Already have an account? <a href="../Login/indexL.php">Login</a></p>
            </div>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/7bebefff04.js" crossorigin="anonymous"></script>
</body>
</html>
