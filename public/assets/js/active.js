var path = window.location.pathname;

var links = document.querySelectorAll('.sidebar-nav a');

links.forEach(function(link) {
    
    if (link.getAttribute('href') === path) {
        link.parentNode.classList.add('active');
    }
});