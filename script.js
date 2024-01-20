// Mock data for posts
const posts = [
    { id: 1, content: "This is a sample post.", user: "John Doe" },
    { id: 2, content: "Another post here.", user: "Jane Smith" },
    // Add more posts as needed
];

document.addEventListener("DOMContentLoaded", function () {
    updatePostFeed();

    // Event listener for post form submission
    document.getElementById("postForm").addEventListener("submit", function (event) {
        event.preventDefault();
        createPost();
    });

    // Event delegation for like and share buttons
    document.getElementById("postFeed").addEventListener("click", function (event) {
        const target = event.target;

        if (target.tagName === "BUTTON") {
            const postId = target.dataset.postId;

            if (target.classList.contains("likeButton")) {
                likePost(postId);
            } else if (target.classList.contains("shareButton")) {
                sharePost(postId);
            }
        }
    });
});

// Function to create a new post
function createPost() {
    const postContent = document.getElementById("postContent").value;

    if (postContent.trim() !== "") {
        // Mock user data (replace with actual user data)
        const user = "John Doe";

        // Mock post object (replace with actual data from the form)
        const newPost = { id: posts.length + 1, content: postContent, user: user };

        // Add the new post to the posts array
        posts.push(newPost);

        // Update the post feed
        updatePostFeed();

        // Clear the post form
        document.getElementById("postContent").value = "";
    }
}

// Function to update the posts feed
function updatePostFeed() {
    const postFeed = document.getElementById("postFeed");

    // Clear existing posts
    postFeed.innerHTML = "";

    // Render each post
    posts.forEach(post => {
        const postElement = document.createElement("div");
        postElement.classList.add("post");

        // Post content
        const contentElement = document.createElement("p");
        contentElement.textContent = post.content;
        postElement.appendChild(contentElement);

        // User information
        const userElement = document.createElement("p");
        userElement.textContent = "Posted by: " + post.user;
        postElement.appendChild(userElement);

        // Like and Share buttons
        const actionsElement = document.createElement("div");
        actionsElement.classList.add("post-actions");
        actionsElement.innerHTML = `
            <button class="likeButton" data-post-id="${post.id}">Like</button>
            <button class="shareButton" data-post-id="${post.id}">Share</button>
        `;
        postElement.appendChild(actionsElement);

        postFeed.appendChild(postElement);
    });
}

// Function to simulate liking a post
function likePost(postId) {
    // Implement actual like functionality here
    console.log("Liked post with ID: " + postId);
}

// Function to simulate sharing a post
function sharePost(postId) {
    // Implement actual share functionality here
    console.log("Shared post with ID: " + postId);
}
