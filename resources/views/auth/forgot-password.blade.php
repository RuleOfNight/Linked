@extends('layouts.app')

@section('content')
    <div>
        <h2>Quên mật khẩu</h2>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <input type="email" name="email" placeholder="Nhập email" required>
            <button type="submit">Gửi email đặt lại mật khẩu</button>
        </form>
    </div>
@endsection
