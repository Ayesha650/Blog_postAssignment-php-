<?php
// Include the database connection file (db.php)
include('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Prepare the SQL statement to retrieve the user's information
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");

        // Bind parameters
        $stmt->bindParam(':username', $username);

        // Execute the statement
        $stmt->execute();

        // Fetch the user record
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the user exists and verify the password
        if ($user && password_verify($password, $user['password'])) {
            // Authentication successful
            echo "Login successful! Welcome, " . $user['username'];

            // You might want to set session variables or perform other actions upon successful login
        } else {
            // Authentication failed
            echo "Invalid username or password";
        }

    } catch (PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- HTML form for user login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<body>

<h2>User Login</h2>

<form method="post" action="login.php">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <br>

    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <br>

    <button type="submit">Login</button>
</form>

</body>
</html>
