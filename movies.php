<?php
include('common/login_check.php');

if (isset($_GET['title'])) {
    $title = urlencode($_GET['title']);
    $apiKey = 'b1f21804'; // replace with your OMDB API key
    $url = "http://www.omdbapi.com/?t=$title&apikey=$apiKey";
    
    $response = file_get_contents($url);
    // print_r($response);
    $movie = json_decode($response, true);
    
    if ($movie['Response'] == 'True') {
        echo "<h2>" . $movie['Title'] . "</h2>";
        echo "<img src='" . $movie['Poster'] . "' alt='Movie Poster'>";
        echo "<p>" . $movie['Plot'] . "</p>";
        echo "<button onclick='addFavorite(\"" . $movie['Title'] . "\", \"" . $movie['imdbID'] . "\", \"" . $movie['Poster'] . "\")'>Add to Favorites</button>";
    } else {
        echo "Movie not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies - Movies App</title>
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
                <h1>Search your movie here</h1>
            </header>
            <div class="search_bar"> 
                <input type="text" id="movieTitle" placeholder="Enter movie title">
                <button onclick="searchMovie()" class="btn">Search</button>
            </div>
            

            <div id="movieInfo" class="movie-info"></div>
        </div>
    </div>
    <!-- Link to external JavaScript file -->
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>