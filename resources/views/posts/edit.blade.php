<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="{{ asset('css/post-edit.css') }}">

</head>
<body>
    <div class="container">
        <h1>Edit Post</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="{{ $post->title }}" required>
            </div>

            <div>
                <label for="content">Content:</label>
                <textarea id="content" name="content" required>{{ $post->content }}</textarea>
            </div>

            <div>
                <label for="image">Image (Optional):</label>
                <input type="file" id="image" name="image">
                @if($post->image)
                    <div class="current-image-container">
                        <p>Current Image:</p>
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Current Post Image">
                    </div>
                @endif
            </div>

            <div class="buttons">
                <button type="submit">Update Post</button>
                <a href="{{ route('posts.index') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>