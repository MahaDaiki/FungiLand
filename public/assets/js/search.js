document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault();
    let formData = new FormData(this);
    fetch('/search', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        const postsContainer = document.querySelector('.searched');
        var allposts = document.querySelector('.allposts');
        const postDetailsRoute = "/posts"; 
        postsContainer.innerHTML = '';
        if (data.length === 0) {
            allposts.classList.remove('d-none');
            postsContainer.innerHTML = '<h1>No Posts Found</h1>';
        } else {
            allposts.classList.add('d-none');
            data.forEach(post => {
                let postHTML = `
                    <div class="col-md-12 mb-4">
                        <div class="panel blog-container">
                            <div class="panel-body">
                                <div class="image-wrapper">
                                    <a class="d-flex justify-content-center align-items-center pt-2" href="#">
                                        <img src="/storage/${post.image}" width="400" alt="Photo of Blog">
                                        <div class="image-overlay"></div> 
                                    </a>
                                </div>
                                <div class="container mb-4">
                                    <h1 class="text-center">${post.title}</h1>
                                    <small class="text ml-4">By <a href="#"><strong>${post.user.name}</strong></a> | Post on ${post.created_at} | ${post.type} |${post.category.name}</small>
                                    <p class="fs-4">
                                        ${post.content}
                                    </p>`;
                post.tags.forEach(tag => {
                    postHTML += `<a href="" class="ml-2">#${tag.name}</a>`;
                });
                postHTML += ` <a href="${postDetailsRoute}/${post.id}" class="float-right mb-5"><img src="{{ asset('assets/images/comments.png') }}" width="70" alt="Continue Reading"></a>

                                <span class="post-like text-muted tooltip-test" data-toggle="tooltip" data-original-title="I like this post!">
                                    <span class="like-count">${post.likes_count}</span>
                                    <button class="like-btn change like" data-post-id="${post.id}" data-url="{{ route('posts.like', $post) }}"><i class="fa fa-heart"></i></button>
                                    <button class="unlike-btn change like" data-post-id="${post.id}" data-url="{{ route('posts.unlike', $post) }}" style="display: none;"><i class="fa fa-heart text-danger"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>`;
                postsContainer.insertAdjacentHTML('beforeend', postHTML);
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
