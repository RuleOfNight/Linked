<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linked</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex; 
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            display: flex;
            max-width: 1200px;
            width: 95%;
            margin: 20px;
            position: relative;
            left: -90px;
        }

        /* Phần bên trái (Profile Card) */
        .profile-card {
            width: 300px;
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.5);
            margin-right: 20px;
            position: sticky;
            top: 20px;
            height: fit-content;
        }

        .profile-picture {
            width: 220px;
            height: 220px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #f0f0f0;
            transition: transform 0.3s ease, border-color 0.3s ease;
        }

        .profile-picture:hover {
            transform: scale(1.05);
            border-color: #007bff;
        }

        .profile-name {
            font-size: 1.8em;
            margin-bottom: 10px;
        }

        .profile-bio {
            font-size: 1em;
            color: #ccc;
            margin-bottom: 20px;
        }

        .social-links {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .social-link {
            display: block;
            background-color: #333;
            color: #f0f0f0;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            transform: scale(1);
        }

        .social-link:hover {
            background-color: #555;
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            color: #fff;
        }

        .social-link .tooltip {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f0f0f0;
            color: #121212;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9em;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.3s ease;
            transform: translateX(-50%) translateY(10px);
        }

        .social-link:hover .tooltip {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }



        .blog-area {
            flex: 1;
            padding: 20px;
        }

        .blog-heading {
            font-size: 2em;
            margin-bottom: 20px;
        }

        .blog-posts {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .blog-post {
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .blog-post h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #f0f0f0;
        }

        .blog-post p {
            font-size: 1em;
            color: #ccc;
            line-height: 1.6;
        }

        .blog-post img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .blog-post small {
            color: #777;
            display: block;
            margin-top: 10px;
        }

        .top-left-buttons {
            position: relative;
            top: 20px;
            left: 20px;
            display: flex;
            gap: 10px;
        }

        .top-left-buttons a, .top-left-buttons button {
            background-color: #333;
            color: #f0f0f0;
            padding: 10px 15px;
            border-radius: 5px;
            margin-right: 250px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .top-left-buttons a:hover, .top-left-buttons button:hover {
            background-color: #555;
        }
        .top-left-buttons form input {
            width: 200px;
            height: 35px;
        }

        .top-right-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
        }

        .top-right-buttons a, .top-right-buttons button {
            background-color: #333;
            color: #f0f0f0;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .top-right-buttons a:hover, .top-right-buttons button:hover {
            background-color: #555;
        }

    </style>
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
            <h2 class="blog-heading">My Blog</h2>
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
                            <!-- Like -->
                            <form action="{{ route('posts.like', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit">Like</button>
                            </form>
                            <p>Liked by {{ $post->likes->count() }} people</p>

                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

</body>
</html>