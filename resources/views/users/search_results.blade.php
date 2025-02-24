@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Search Results</h2>
    @if($users->isEmpty())
        <p>No users found.</p>
    @else
        <ul>
            @foreach ($users as $user)
                <li>{{ $user->name }} - <a href="{{ route('profile', $user->id) }}">View Profile</a></li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
