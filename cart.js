

document.addEventListener('DOMContentLoaded', function() {
    var cards = document.querySelectorAll('.cart-item-card');
    cards.forEach(function(card, index) {
        setTimeout(function() {
            card.style.opacity = '1';
        }, index * 100);
    });
});