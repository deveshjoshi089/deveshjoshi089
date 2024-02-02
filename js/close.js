
    // Wait for the DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        // Get the close button and form elements
        var closeButton = document.getElementById('closeButton');
        var myForm = document.getElementById('myForm');

        // Attach a click event listener to the close button
        closeButton.addEventListener('click', function() {
            // Hide the form when the close button is clicked
            myForm.style.display = 'none';
        });
    });
