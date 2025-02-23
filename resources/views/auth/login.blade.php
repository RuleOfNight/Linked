<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linked</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    
</head>
<body>

<div class="background">
    <div class="form-container">
        <div class="form-wrapper">
            <!-- Form đăng nhập -->
            <div class="form login-form">
                <h2 style="color: white;">Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-box">
                        <input type="email" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" required>
                        <label>Password</label>
                    </div>
                    <button type="submit" class="btn">Sign in</button>
                </form>
                <p>Don't have an account? <span class="toggle" data-target="register-form">Register</span></p>
            </div>

            <!-- Form đăng ký -->
            <div class="form register-form">
                <h2 style="color: white;">Registration</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-box">
                        <input type="text" name="name" required>
                        <label>Name</label>
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" required>
                        <label>Email Address</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" required>
                        <label>Create Password</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password_confirmation" required>
                        <label>Confirm Password</label>
                    </div>
                    <button type="submit" class="btn">Register Account</button>
                </form>
                <p>Already have an account? <span class="toggle" data-target="login-form">Login</span></p>
            </div>
        </div>
    </div>
</div>


    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
