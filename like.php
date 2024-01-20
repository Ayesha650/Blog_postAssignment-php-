<?php
// Include the database connection file (db.php)
include('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input from the form
    $postId = $_POST['post_id'];
    // Assuming you have a way to get the user ID, replace this with the actual user ID
    $userId = 1;

    try {
        // Check if the user has already liked the post
        $stmt = $pdo->prepare("SELECT id FROM likes WHERE user_id = :user_id AND post_id = :post_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':post_id', $postId);
        $stmt->execute();

        $existingLike = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$existingLike) {
            // User hasn't liked the post yet, so insert a new like
            $stmt = $pdo->prepare("INSERT INTO likes (user_id, post_id) VALUES (:user_id, :post_id)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':post_id', $postId);
            $stmt->execute();

            echo "Like added successfully!";
        } else {
            // User has already liked the post, you may want to handle this case accordingly
            echo "You have already liked this post.";
        }

    } catch (PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- HTML form for liking a post -->
<!-- This form should be included in each post in your UI -->
<form method="post" action="like.php">
    <input type="hidden" name="post_id" value="1"> <!-- Replace with the actual post ID -->
    <button type="submit">Like</button>
</form>
