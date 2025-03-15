<?php
include('common/login_check.php');
include('common/db.php');
// Get the user_id from session
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM favorite_movies WHERE user_id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $user_id);  // Bind user_id parameter
    $stmt->execute();
    $result = $stmt->get_result();
    
    $favorites = [];
    while ($row = $result->fetch_assoc()) {
        $favorites[] = $row;  // Add each favorite movie to the array
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Movies App</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="styles/dashboard_style.css">
   
</head>
<body>
    <!-- Dashboard Container -->
    <div class="dashboard">
        <!-- Navigation Sidebar -->
        <?php
        include('common/sidebar.php');
        ?>

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Header Section -->
            <header>
                <h1>Welcome, User</h1>
                <h3>Here are your favourite movies.</h3>
            </header>

            <!-- Widgets Section -->
            <section class="widgets">
                <?php
                foreach ($favorites as $key => $favorite) {
                ?>
                <div class="widget">
                    <h3><?= $favorite['movie_title'] ?> - <?= $favorite['movie_id'] ?></h3>
                    <img src="<?= $favorite['poster_url'] ?>">
                </div>
                <?php
                }
                ?>
               
            </section>
        </div>
    </div>
    <!-- Link to external JavaScript file -->
    <script src="js/script.js"></script>
</body>
</html>