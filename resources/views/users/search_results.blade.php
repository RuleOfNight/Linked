@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <h1>Search Results</h1>
        <div class="search-results">
            @if ($users->isEmpty())
                <p>No users found.</p>
            @else
                @foreach ($users as $user)
                    <div class="user-card">
                        <img src="{{ asset($user->profile_picture ? 'storage/' . $user->profile_picture : '/storage/images/default-avatar.jpg') }}" alt="Profile Picture" class="profile-picture">
                        <h3>
                            <a href="{{ route('profile', $user->name) }}">{{ $user->name }}</a>
                        </h3>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</body>
@endsection