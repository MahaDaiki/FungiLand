
    document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll('.edit-comment-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const cardBody = this.parentElement;
                const editForm = cardBody.querySelector('.edit-comment-form');
                const commentText = cardBody.querySelector('.card-text');

                if (editForm.style.display === 'none') {
                    editForm.style.display = 'block';
                    commentText.style.display = 'none';
                } else {
                    editForm.style.display = 'none';
                    commentText.style.display = 'block';
                }
            });
        });
    });

