@extends('layouts.app')

@section('title', 'Search Results')

@section('styles')
    <style>
        .search-results {
            margin-top: 20px;
        }
        .user-card {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 10px;
            background-color: #fff;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .profile-picture {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            object-fit: cover;
        }
        .user-card h3 {
            margin: 0;
            font-size: 1.2rem;
        }
        .user-card h3 a {
            text-decoration: none;
            color: #333;
        }
        .user-card h3 a:hover {
            color: #007bff;
        }
        .no-results {
            text-align: center;
            font-size: 1.1rem;
            color: #666;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center">Search Results</h1>
        <div class="search-results">
            @if ($users->isEmpty())
                <p class="no-results">No users found.</p>
            @else
                @foreach ($users as $user)
                    <div class="user-card">
                        <img src="{{ asset($user->profile_picture ? 'storage/' . $user->profile_picture : 'images/default-avatar.jpg') }}" 
                             alt="Profile Picture" 
                             class="profile-picture">
                        <h3>
                            <a href="{{ route('profile', $user->id) }}">{{ $user->name }}</a>
                        </h3>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection