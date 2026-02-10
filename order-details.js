
window.onload = function() {
    initializeAnimations();
};

function initializeAnimations() {
    var orderItems = document.querySelectorAll('.order-item');
    
    orderItems.forEach(function(item, index) {
        setTimeout(function() {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            item.style.transition = 'all 0.5s ease';
            
            setTimeout(function() {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, 50);
        }, index * 100);
    });
}

function confirmCancelOrder(event) {
    alert(
        "Your order has been cancelled.\n\n" +
        "This action cannot be undone."
    );
}

function addButtonEffects() {
    var buttons = document.querySelectorAll('.btn-action');
    
    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            button.style.transform = 'scale(0.95)';
            
            setTimeout(function() {
                button.style.transform = '';
            }, 150);
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    addButtonEffects();
});
