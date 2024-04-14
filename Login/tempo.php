
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeyChain</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav>
        <div class="logo">KeyChain</div>
        <ul>
            <li>Home</li>
            <li>About</li>
            <li>Contact</li>
        </ul>
    </nav>
    <div class="container">
        <h1>Password Manager</h1>
        <p><i>NOW NO NEED TO REMEMBER YOUR PASSWORDS WHEN I AM HERE , I CAN SAVE YOUR PASSWORDS OF RESPECTIVE WEBSITES SO YOU CAN ACCESS IT AND USE IT.</i></p>
        <br>
        <h2>Your Passwords <span id="alert"></span></h2> 
        <table>
            <tr>
                <th>Website</th>
                <th>Username</th>
                <th>Password</th>
                <th>Delete</th>
            </tr> 
 
        </table>

        <h2>Add a Password</h2>
        <form action="/submit" method="post">

            <!-- Text input for website -->
            <label for="website">Website:</label>
            <input type="text" id="website" name="website" required>
            <br><br>

            <!-- Text input for username -->
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br><br>

            <!-- Password input -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <!-- Submit button -->
            <button class="btn" type="submit">Submit</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>

</html>