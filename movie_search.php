<?php
if (isset($_GET['title'])) {
    $title = urlencode($_GET['title']);
    $apiKey = 'b1f21804'; // Replace with your OMDB API key
    $url = "http://www.omdbapi.com/?t=$title&apikey=$apiKey";
    
    // Make the API call to OMDB
    $response = file_get_contents($url);
    $movie = json_decode($response, true);
    
    // Check if the response is valid
    if ($movie['Response'] == 'True') {
        // Return movie data as JSON
        echo json_encode([
            'success' => true,
            'title' => $movie['Title'],
            'poster' => $movie['Poster'],
            'plot' => $movie['Plot'],
            'imdbID' => $movie['imdbID']
        ]);
    } else {
        // If movie is not found, return an error message
        echo json_encode([
            'success' => false,
            'message' => 'Movie not found.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No movie title provided.'
    ]);
}
?>
