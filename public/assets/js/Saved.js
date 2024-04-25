document.addEventListener('DOMContentLoaded', function() {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    var saveButtons = document.querySelectorAll('.save-btn');
    var unsaveButtons = document.querySelectorAll('.unsave-btn');

    saveButtons.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var postId = this.getAttribute('data-post-id');
            var saveUrl = this.getAttribute('data-save-url');
            var unsaveUrl = this.getAttribute('data-unsave-url');

            fetch(saveUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ postId: postId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.saved) {
                    btn.nextElementSibling.style.display = 'inline-block';
                    btn.style.display = 'none';
                }
            })
            .catch(error => console.error(error));
        });
    });

    unsaveButtons.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var postId = this.getAttribute('data-post-id');
            var saveUrl = this.getAttribute('data-save-url');
            var unsaveUrl = this.getAttribute('data-unsave-url');

            fetch(unsaveUrl, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ postId: postId })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.saved) {
                    btn.previousElementSibling.style.display = 'inline-block';
                    btn.style.display = 'none';
                }
            })
            .catch(error => console.error(error));
        });
    });
});
