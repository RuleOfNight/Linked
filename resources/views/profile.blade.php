@extends('layouts.app')

@section('title', $user->name . "'s Profile")

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
    <div class="container">
        <!-- Profile Card -->
        <div class="profile-card">
            <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('avatars/default-avatar.jpg') }}" 
                 alt="Profile Picture" 
                 class="profile-picture">
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

        <!-- Blog Area -->
        <div class="blog-area">
            <h2 class="blog-heading">{{ $user->name }}'s Blog</h2>
            <div class="blog-posts">
                @if ($posts->isEmpty())
                    <p>No posts found.</p>
                @else
                    @foreach ($posts as $post)
                        <div class="blog-post">
                            <a href="{{ route('posts.show', $post->id) }}">
                                <h3>{{ $post->title }}</h3>
                                <p>{{ Str::limit($post->content, 200) }}</p>
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="post-image">
                                @endif
                                <small>Created at: {{ $post->created_at->format('M d, Y') }}</small>
                            </a>

                            <!-- Like Button -->
                            <form action="{{ route('posts.like', $post->id) }}" method="POST" class="like-button">
                                @csrf
                                <button type="submit" class="like-button">Like ({{ $post->likes->count() }})</button>
                            </form>

                                <!-- Pinned Comments -->
                                @if ($post->comments->where('pinned', true)->count() > 0)
                                    <div class="pinned-comments">
                                        <h5 class="mb-3">📌 Pinned Comments</h5>
                                        @foreach ($post->comments->where('pinned', true) as $comment)
                                            <div class="pinned-comment">
                                                <div class="card-body">
                                                    <strong>{{ $comment->user->name }}</strong>
                                                    <p>{{ $comment->content }}</p>
                                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection