<?php
// Include the database connection file (db.php)
include('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    // You might want to add more fields like email, name, etc., depending on your user registration requirements.

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepare the SQL statement to insert the user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);

        // Execute the statement
        $stmt->execute();

        // Provide feedback to the user
        echo "Registration successful!";

    } catch (PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- HTML form for user registration -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>

<h2>User Registration</h2>

<form method="post" action="register.php">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <br>

    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <br>

    <!-- Add more fields as needed for your registration form -->

    <button type="submit">Register</button>
</form>

</body>
</html>
