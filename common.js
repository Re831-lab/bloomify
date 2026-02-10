
window.addEventListener('scroll', function() {
    var navbar = document.querySelector('.navbar'); 
    if (navbar) {
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
});


document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {


    anchor.addEventListener('click', function(e) {
        var target = this.getAttribute('href');
        if (target !== '#') {
            e.preventDefault();
            var element = document.querySelector(target);
            if (element) {
                element.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }
    });
});