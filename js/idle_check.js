let timeout; // Timer variable

// Function to reset the timeout
function resetTimeout() {
    clearTimeout(timeout);
    timeout = setTimeout(logoutUser, 10 * 60 * 1000); // 10 minutes in milliseconds
}

// Function to handle user activity
function handleUserActivity() {
    resetTimeout();
    // Additional code to handle user activity (e.g., updating UI, etc.)
}

// Function to logout the user via AJAX
function logoutUser() {
    $.ajax({
        url: "php/logout.php",
        type: "GET",
        data: {user: ''},
        success: function(response) {
            // Redirect or handle logout success
        },
        error: function(xhr, status, error) {
            console.error("Error logging out user:", error);
            // Optionally provide feedback to the user
        }
    });
}

// Event listeners to detect user activity
$(document).on('mousemove keydown', function() {
    handleUserActivity();
});