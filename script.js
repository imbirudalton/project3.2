// JavaScript for form validation
document.addEventListener('DOMContentLoaded', function() {
    var form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        var username = form.querySelector('input[name="username"]').value;
        var password = form.querySelector('input[name="password"]').value;

        if (!username || !password) {
            event.preventDefault(); // Prevent form submission
            alert('Please fill in both username and password fields.');
        }
    });
});
