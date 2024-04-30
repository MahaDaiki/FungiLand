
document.addEventListener('DOMContentLoaded', function() {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    var likeButtons = document.querySelectorAll('.like-btn');
    var unlikeButtons = document.querySelectorAll('.unlike-btn');

    likeButtons.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var postId = this.getAttribute('data-post-id');
            var url = `http://127.0.0.1:8000/posts/${postId}/like` ;
            var likeCountSpan = this.parentElement.querySelector('.like-count');

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ postId: postId })
            })
            .then(response => response.json())
            .then(data => {
                likeCountSpan.textContent = data.likes_count;
                btn.style.display = 'none';
                btn.nextElementSibling.style.display = 'inline';
            })
            .catch(error => console.error(error));
        });
    });

    unlikeButtons.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var postId = this.getAttribute('data-post-id');
            var url = `http://127.0.0.1:8000/posts/${postId}/unlike`;
            var likeCountSpan = this.parentElement.querySelector('.like-count');

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ postId: postId })
            })
            .then(response => response.json())
            .then(data => {
                likeCountSpan.textContent = data.likes_count;
                btn.style.display = 'none';
                btn.previousElementSibling.style.display = 'inline';
            })
            .catch(error => console.error(error));
        });
    });
});
document.title = 'test';
