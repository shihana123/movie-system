<?php
// ini_set('display_errors', 0);
    include('common/db.php');
    $successMessage = ""; // Variable to hold success or error message
    $errorMessage = "";   // Variable to hold error message
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing

        $exist_sql = "SELECT * FROM users WHERE email = '$email' OR username = '$username'";
        $result = $conn->query($exist_sql);
        if($result->num_rows > 0)
        {
            $errorMessage = "Username or password already exits" . $conn->error; // Set error message if any
        }
        else
        {
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            if ($conn->query($sql) === TRUE) {
                $successMessage = "Registration successful!"; // Set success message
            } else {
                $errorMessage = "Error: " . $conn->error; // Set error message if any
            }
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form - Movies App</title>
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
                <?php if (!empty($successMessage)): ?>
                    <p class="success"><?php echo $successMessage; ?></p>
                <?php endif; ?>
                
                <?php if (!empty($errorMessage)): ?>
                    <p class="error"><?php echo $errorMessage; ?></p>
                <?php endif; ?>
                
                <!-- Form for user input -->
                <form action="#" method="POST">
                    <!-- Input group for username -->
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <!-- Input group for email  -->
                    <div class="input-group">
                        <label for="username">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <!-- Input group for password -->
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <!-- Actions section containing the Sign In button and forgot password link -->
                    <div class="actions">
                        <button type="submit" class="btn">Register</button>
                    </div>
                    
                    <!-- Section for account creation -->
                    <div class="create-account">
                        <p>Have an account in  Movies App? <a href="index.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>