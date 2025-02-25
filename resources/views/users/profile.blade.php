<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Profile</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <img src="{{ asset($user->profile_picture ? 'storage/' . $user->profile_picture : '/storage/images/default-avatar.jpg') }}" alt="Profile Picture" class="profile-picture">
            <h1 class="profile-name">{{ $user->name }}</h1>
            <p class="profile-bio">{{ $user->bio }}</p>

            <div class="social-links">
                @if(count($user->socialLinks) > 0)
                    @foreach ($user->socialLinks as $socialLink)
                        <a href="{{ $socialLink->link_url }}" class="social-link">
                            {{ $socialLink->link_text }}
                        </a>
                    @endforeach
                @else
                    <p>No social links added yet.</p>
                @endif
            </div>
        </div>

        <div class="blog-area">
            <h2 class="blog-heading">{{ $user->name }}'s Posts</h2>
            <div class="blog-posts">
                @if ($posts->isEmpty())
                    <p>No posts found.</p>
                @else
                    @foreach ($posts as $post)
                        <div class="blog-post">
                            <h3>{{ $post->title }}</h3>
                            <p>{{ $post->content }}</p>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
                            @endif
                            <small>Created at: {{ $post->created_at }}</small>

                            <!-- Like Button -->
                            <form action="{{ route('posts.like', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-like">Like</button>
                            </form>

                            <!-- Comment Form -->
                            <form action="{{ route('posts.comment', $post->id) }}" method="POST" style="margin-top: 10px;">
                                @csrf
                                <textarea name="content" placeholder="Add a comment..." required></textarea>
                                <button type="submit" class="btn btn-comment">Comment</button>
                            </form>

                            <!-- Display Comments -->
                            <div class="comments">
                                @foreach ($post->comments as $comment)
                                    <div class="comment">
                                        <strong>{{ $comment->user->name }}</strong>
                                        <p>{{ $comment->content }}</p>
                                        <small>{{ $comment->created_at }}</small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</body>
</html>