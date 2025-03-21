<?php
    include('common/db.php');
    session_start();
    $errorMessage = "";   // Variable to hold error message
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: dashboard.php'); // Redirect to dashboard after successful login
            } else {
                $errorMessage = "Invalid password!";
            }
        } else {
            $errorMessage = "No user found with that email!";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form - Movies App</title>
    <!-- Link to Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@400;500&display=swap">
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <!-- Main container for centering the login card on the screen -->
    <div class="container">
        <!-- Login card containing both the image and the form -->
        <div class="login-card">
            <!-- Left side of the card containing the decorative image -->
            <div class="card-left">
                <div class="image-cover">
                    <img src="images/movie.jpg">
                </div>
            </div>
            <!-- Right side of the card containing the login form -->
            <div class="card-right">
                <!-- Title of the login form -->
                <h1 class="title">Movies App</h1>
                <!-- Display success or error message -->
               
                <?php if (!empty($errorMessage)): ?>
                    <p class="error"><?php echo $errorMessage; ?></p>
                <?php endif; ?>
                <!-- Form for user input -->
                <form action="#" method="POST">
                    <!-- Input group for username  -->
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    
                    <!-- Input group for password -->
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <!-- Actions section containing the Sign In button and forgot password link -->
                    <div class="actions">
                        <button type="submit" class="btn">Log in</button>
                    </div>
                    
                    <!-- Section for account creation -->
                    <div class="create-account">
                        <p>New to Movies App? <a href="register.php">Create Account</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>