

document.addEventListener('DOMContentLoaded', function() {
    var registerForm = document.getElementById('registerForm');
    
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            
            // Get form values
            var fullName = document.getElementById('fullName').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirmPassword').value;
            var termsChecked = document.getElementById('terms').checked;
            
           var hasError=false;

            // Simple validation
            if (fullName.length < 3) {
                alert('✗ Please enter your full name (at least 3 characters)');
                hasError=true;
            }
            
            if (!validateEmail(email)) {
                alert('✗ Please enter a valid email address');
                hasError=true;
            }
            
            if (!validatePassword(password)) {
                alert('✗ Password must be at least 8 characters with uppercase, lowercase and numbers');
                hasError=true;
            }
            
            if (password !== confirmPassword) {
                alert('✗ Passwords do not match');
                hasError=true;
            }
            
            if (!termsChecked) {
                alert('✗ Please agree to the Terms & Conditions');
                hasError=true;
            }
            

            if (hasError) {
                e.preventDefault();
            }

     
        });
    }
});






