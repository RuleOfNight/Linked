<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Profile</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <navbar>
        <div class="top-left-buttons">
            <form action="{{ route('search') }}" method="GET">
                <input type="text" name="query" placeholder="Search users..." required>
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="top-right-buttons">
            <a href="{{ route('posts.index') }}" class="profile-link">Posts</a>
            <a href="{{ route('profile.edit') }}" class="profile-link">Profile</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="profile-link">Đăng xuất</button>
            </form>
        </div>
    </navbar>

    <div class="container">
        <div class="profile-card">
            <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('avatars/default-avatar.jpg') }}" alt="Profile Picture" class="profile-picture">
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
            <h2 class="blog-heading">{{ $user->name }}'s Blog</h2>
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
                            <form action="{{ route('posts.like', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit">Like</button>
                            </form>
                            <p>Liked by {{ $post->likes->count() }} people</p>

                            <!-- Comment Form -->
                            <form action="{{ route('posts.comment', $post->id) }}" method="POST">
                                @csrf
                                <textarea name="content" placeholder="Add a comment..." required></textarea>
                                <button type="submit">Comment</button>
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