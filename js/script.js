function searchMovie() {
    var title = document.getElementById('movieTitle').value;
    if (title.trim() === "") {
        alert("Please enter a movie title");
        return;
    }

     // Perform AJAX request to movie_search.php
     $.ajax({
        url: 'movie_search.php',
        type: 'GET',
        data: { title: title },
        dataType: 'json',
        success: function(response) {
            // Clear previous movie info
            $('#movieInfo').empty();

            if (response.success) {
                // Display movie info if the search was successful
                var movieHtml = `
                    <br>
                    <h2>${response.title}</h2>
                    <br>
                    <img src="${response.poster}" alt="Movie Poster">
                    <br>
                    <h5>${response.plot}</h5>
                    <br>
                    <button class="btn" onclick="addFavorite('${response.title}', '${response.imdbID}', '${response.poster}')">Add to Favorites</button>
                `;
                $('#movieInfo').html(movieHtml);
            } else {
                // Display error message if the movie was not found
                $('#movieInfo').html(`<p class="error">${response.message}</p>`);
            }
        },
        error: function() {
            // Handle AJAX error
            $('#movieInfo').html('<p class="error">An error occurred while fetching the movie data. Please try again.</p>');
        }
    });
    console.log(title);
    
}

function addFavorite(title, imdbID, poster) {
    // Make an AJAX request to add the movie to favorites
    $.ajax({
        url: 'add_favorite.php',
        type: 'POST',
        data: {
            movie_title: title,
            movie_id: imdbID,
            poster_url: poster
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message); // Show success message
                window.location.href = "dashboard.php";
            } else {
                alert('Error: ' + response.message); // Show error message
            }
        },
        error: function() {
            alert('An error occurred while adding to favorites.');
        }
    });
}