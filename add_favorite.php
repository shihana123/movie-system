<?php
session_start();
require_once 'common/db.php'; // Make sure to include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

// Ensure the required data is provided
if (isset($_POST['movie_title']) && isset($_POST['movie_id']) && isset($_POST['poster_url'])) {
    // Get user ID from session
    $user_id = $_SESSION['user_id'];
    $movie_title = $_POST['movie_title'];
    $movie_id = $_POST['movie_id'];
    $poster_url = $_POST['poster_url'];

    $exist_sql = "SELECT * FROM favorite_movies WHERE movie_id = '$movie_id' AND user_id = '$user_id'";
    $result = $conn->query($exist_sql);
    if($result->num_rows > 0)
    {
        echo json_encode(['success' => false, 'message' => 'Movie alreday in your favourite list']); // Set error message if any
    }
    else
    {
    // Insert favorite movie into the database
        $sql = "INSERT INTO favorite_movies (user_id, movie_title, movie_id, poster_url) 
        VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param("isss", $user_id, $movie_title, $movie_id, $poster_url);

        // Execute the query
        if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Movie added to favorites']);
        } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add movie to favorites']);
        }

        $stmt->close();
        } else {
        echo json_encode(['success' => false, 'message' => 'Error in query preparation']);
        }
        } 
    }
    else {
        echo json_encode(['success' => false, 'message' => 'Required parameters missing']);
        }
    
        $conn->close();
    
?>
