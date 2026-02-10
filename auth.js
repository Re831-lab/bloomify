document.addEventListener('DOMContentLoaded', function() {
    var card = document.querySelector('.auth-card');
    if (card) {
        setTimeout(function() {
            card.classList.add('show');
        }, 100);
    }
});

function validateEmail(email) {
    if (email.length < 5) return false;
    if (email.indexOf('@') === -1) return false;
    if (email.indexOf('.') === -1) return false;
    if (email.indexOf('@') > email.lastIndexOf('.')) return false;
    return true;
}

function validatePassword(password) {
    if (password.length < 8) return false;
    
    var hasUpper = false; 
    var hasLower = false;  
    var hasNumber = false; 
    
    for (var i = 0; i < password.length; i++) {  
        var char = password[i];
        if (char >= 'A' && char <= 'Z') hasUpper = true;
        if (char >= 'a' && char <= 'z') hasLower = true;
        if (char >= '0' && char <= '9') hasNumber = true;
    }
    
    return hasUpper && hasLower && hasNumber;
}

function showAlert(message, type) {
    if (type === 'success') {
        alert('✓ ' + message);
    } else {
        alert('✗ ' + message);
    }
}