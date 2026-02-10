
document.addEventListener('DOMContentLoaded', function() {
    var dateInput = document.querySelector('input[name="delivery_date"]');
    if (dateInput) {
        var today = new Date().toISOString().split('T')[0];
        dateInput.min = today;
    }
    
    var cards = document.querySelectorAll('.checkout-card');
    cards.forEach(function(card, index) {
        setTimeout(function() {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});

var cardMessageInput = document.querySelector('textarea[name="card_message"]');
if (cardMessageInput) {
    cardMessageInput.addEventListener('input', function() {
        var remaining = 200 - this.value.length;
        var counter = this.nextElementSibling;
        if (counter && counter.tagName === 'SMALL') {
            counter.textContent = 'Max 200 characters (' + remaining + ' remaining)';
        }
    });
}