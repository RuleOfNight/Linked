@extends('layouts.app')

@section('title', 'Post Detail')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

@endsection

@section('content')
    <div class="container">
        <!-- Blog Area -->
        <div class="post-detail">
            <div class="card-body">
                <h1 class="card-title">{{ $post->title }}</h1>
                <p class="card-text">{{ $post->content }}</p>
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="post-image">
                @endif
                <small class="text-muted">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</small>

                <!-- Like Button -->
                <form action="{{ route('posts.like', $post->id) }}" method="POST">
                    @csrf
                    <button type="submit">
                        Like ({{ $post->likes->count() }})
                    </button>
                </form>
            </div>
        </div>

        <!-- Comment Form -->
        <div class="comments-section">
            <div class="card-body">
                <h3>💬 Comments</h3>
                @auth
                    <form action="{{ route('posts.comments', $post->id) }}" method="POST">
                        @csrf
                        <div>
                            <textarea name="content" rows="3" placeholder="Write a comment..."></textarea>
                        </div>
                        <button type="submit">Submit</button>
                    </form>
                @else
                    <p class="text-muted">Please <a href="{{ route('login') }}">login</a> to comment.</p>
                @endauth

                <!-- Comments List -->
                <div class="comments-list">
                    @foreach ($post->comments as $comment)
                        <div class="comment">
                            <div class="card-body">
                                <strong>{{ $comment->user->name }}</strong>
                                <p>{{ $comment->content }}</p>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>

                                <!-- Comment Actions (for post owner) -->
                                @if (Auth::id() === $post->user_id)
                                    <div>
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                        <form action="{{ route('comments.pin', $comment->id) }}" method="POST">
                                            @csrf
                                            <button type="submit">
                                                {{ $comment->pinned ? 'Unpin' : 'Pin' }}
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection