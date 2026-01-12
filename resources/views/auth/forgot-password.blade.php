<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<div class="container">
    <h2>Lupa Password</h2>

    @if (session('status'))
        <p class="success">{{ session('status') }}</p>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" required>

        <button type="submit">Kirim Link Reset</button>
    </form>

    <a href="/login">Kembali ke Login</a>
</div>
</body>
</html>
