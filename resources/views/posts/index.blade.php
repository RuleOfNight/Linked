<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts</title>
    <link rel="stylesheet" href="{{ asset('css/post-index.css') }}">
    <style>

    </style>
</head>
<body>

    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('home') }}" class="navbar-brand">Home</a>
        </div>
    </nav>

    
    <div class="container">
        <h1>My Posts</h1>

        <a href="{{ route('posts.create') }}" class="create-post-btn">Create New Post</a>

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
                        <span class="post-meta">Created at: {{ $post->created_at }}</span>

                        <div class="post-actions">
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</body>
</html>