<?php
// Include the database connection file (db.php)
include('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input from the form
    $content = $_POST['content'];

    // You may want to validate and sanitize the input before proceeding

    // Get the user ID from the session or any other authentication method
    $userId = 1; // Replace this with the actual user ID

    try {
        // Prepare the SQL statement to insert the post into the database
        $stmt = $pdo->prepare("INSERT INTO posts (user_id, content) VALUES (:user_id, :content)");

        // Bind parameters
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':content', $content);

        // Execute the statement
        $stmt->execute();

        // Provide feedback to the user
        echo "Post created successfully!";

    } catch (PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
}

// Fetch and display existing posts
try {
    // Prepare the SQL statement to retrieve all posts
    $stmt = $pdo->query("SELECT id, user_id, content, created_at FROM posts ORDER BY created_at DESC");

    // Fetch all posts
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
}
?>

<!-- HTML form for creating a new post -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
</head>
<body>

<h2>Create Post</h2>

<form method="post" action="post.php">
    <label for="content">Post Content:</label>
    <textarea name="content" required></textarea>
    <br>

    <button type="submit">Create Post</button>
</form>

<hr>

<h2>Existing Posts</h2>

<?php
// Display existing posts
foreach ($posts as $post) {
    echo "<p>";
    echo "User ID: " . $post['user_id'] . "<br>";
    echo "Content: " . $post['content'] . "<br>";
    echo "Created At: " . $post['created_at'];
    echo "</p>";
}
?>

</body>
</html>
