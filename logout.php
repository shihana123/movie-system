<?php
// logout.php
session_start(); // Start the session

// Destroy all session data
session_unset();    // Unset all session variables
session_destroy();  // Destroy the session

// Redirect to the login page after logout
header("Location: index.php");  // Adjust this URL to your login page
exit();
?>