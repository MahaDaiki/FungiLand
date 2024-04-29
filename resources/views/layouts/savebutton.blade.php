 @if(auth()->check())
                        <span class="post-save text-muted tooltip-test float-right" data-toggle="tooltip" data-original-title="Save this post!">
                            @if ($post->saves->contains('user_id', auth()->user()->id))
                                <button class="unsave-btn change save" data-post-id="{{ $post->id }}" ><i class="fa fa-bookmark text-warning"></i></button>
                                <button class="save-btn change save" data-post-id="{{ $post->id }}"  style="display: none;"><i class="fa fa-bookmark"></i></button>
                            @else
                                <button class="save-btn change save" data-post-id="{{ $post->id }}" ><i class="fa fa-bookmark"></i></button>
                                <button class="unsave-btn change save" data-post-id="{{ $post->id }}" style="display: none;"><i class="fa fa-bookmark text-warning"></i></button>
                            @endif
                        </span>
                    @endif
                    