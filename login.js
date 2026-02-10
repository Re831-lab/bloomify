
document.addEventListener('DOMContentLoaded', function() {
    var loginForm = document.getElementById('loginForm');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            
            if (!validateEmail(email)) {
                alert('✗ Please enter a valid email address');
                return;
            }
            
            if (password.length < 6) {
                alert('✗ Password must be at least 6 characters');
                return;
            }
            
            alert('✓ Login form submitted! ');

        });
    }
});