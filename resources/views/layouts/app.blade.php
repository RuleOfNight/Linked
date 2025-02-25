<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    

    @yield('styles')
    <style>
        /* CSS cho navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #333;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }

        .navbar .search-form {
            display: flex;
            gap: 10px;
        }

        .navbar .search-form input {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
        }

        .navbar .search-form button {
            padding: 5px 10px;
            background-color: #555;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .navbar .nav-links {
            display: flex;
            gap: 10px;
        }

        .navbar .nav-links a, .navbar .nav-links button {
            background-color: #555;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .navbar .nav-links a:hover, .navbar .nav-links button:hover {
            background-color: #777;
        }

        /* Chữ Linked ở giữa navbar */
        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .navbar .logo:hover {
            color: #ddd;
        }

        /* Đảm bảo nội dung không bị navbar che khuất */
        .content {
            padding-top: 60px; /* Điều chỉnh theo chiều cao của navbar */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <!-- Thanh tìm kiếm -->
        <div class="search-form">
            <form action="{{ route('search') }}" method="GET">
                <input type="text" name="query" placeholder="Search users..." required>
                <button type="submit">Search</button>
            </form>
        </div>


        <a href="{{ route('home') }}" class="logo">Linked</a>

        <!-- Right buttons -->
        <div class="nav-links">
            <a href="{{ route('posts.index') }}" class="profile-link">Posts</a>
            <a href="{{ route('profile.edit') }}" class="profile-link">Profile</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="profile-link">Đăng xuất</button>
            </form>
        </div>
    </div>

    <!-- Main -->
    <div class="content">
        @yield('content')
    </div>
</body>
</html>