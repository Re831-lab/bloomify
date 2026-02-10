
document.addEventListener('DOMContentLoaded', function() {
    var forgotForm = document.getElementById('forgotPasswordForm');
    var successMessage = document.getElementById('successMessage');
    var emailDisplay = document.getElementById('emailDisplay');
    
    if (forgotForm) {
        forgotForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            var email = document.getElementById('email').value;
            
            if (!validateEmail(email)) {
                alert('✗ Please enter a valid email address');
                return;
            }
            
            if (successMessage && emailDisplay) {
                forgotForm.style.display = 'none';
                
                emailDisplay.textContent = email;
                
                successMessage.classList.add('show');
            } else {
                alert('✓ Password reset link sent to: ' + email);
            }
            
        });
    }
});