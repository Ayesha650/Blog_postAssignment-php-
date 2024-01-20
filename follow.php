<?php
// Include the database connection file (db.php)
include('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input from the form
    $followerId = $_POST['follower_id'];  // Current user (follower)
    $followingId = $_POST['following_id'];  // User being followed

    try {
        // Check if the user is already following the target user
        $stmt = $pdo->prepare("SELECT id FROM followers WHERE follower_id = :follower_id AND following_id = :following_id");
        $stmt->bindParam(':follower_id', $followerId);
        $stmt->bindParam(':following_id', $followingId);
        $stmt->execute();

        $existingFollow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$existingFollow) {
            // User is not following the target user, so insert a new follow
            $stmt = $pdo->prepare("INSERT INTO followers (follower_id, following_id) VALUES (:follower_id, :following_id)");
            $stmt->bindParam(':follower_id', $followerId);
            $stmt->bindParam(':following_id', $followingId);
            $stmt->execute();

            echo "You are now following the user!";
        } else {
            // User is already following the target user, you may want to handle this case accordingly
            echo "You are already following this user.";
        }

    } catch (PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- HTML form for following a user -->
<!-- This form should be included on the user profile page or wherever you want to allow users to follow/unfollow -->
<form method="post" action="follow.php">
    <input type="hidden" name="follower_id" value="1"> <!-- Replace with the actual user ID of the follower -->
    <input type="hidden" name="following_id" value="2"> <!-- Replace with the actual user ID of the user being followed -->
    <button type="submit">Follow</button>
</form>
