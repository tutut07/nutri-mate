<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NutriMate</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="container">
    <h2>Login NutriMate</h2>

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('login.process') }}">
        @csrf

        <label>Email</label>
        <input 
            type="email" 
            name="email"
            placeholder="Masukkan email"
            autocomplete="username"
            required
        >

        <label>Password</label>
        <div class="input-wrapper">
            <input 
                type="password" 
                id="password"
                name="password"
                placeholder="Masukkan password"
                autocomplete="current-password"
                required
            >

            <span class="toggle-password" onclick="togglePassword('password', this)">
                <i class="fa-solid fa-eye"></i>
            </span>
        </div>

        <!-- REMEMBER ME -->
        <div class="remember-box">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Ingat saya</label>
        </div>

        <button type="submit">Masuk</button>
        <a href="/" class="btn-home">Kembali ke Home</a>
    </form>

    <p class="text-center">
        <a href="{{ route('password.request') }}">Lupa password?</a>
    </p>

    <p class="text-center">
        Belum punya akun? <a href="{{ url('/register') }}">Daftar di sini</a>
    </p>
</div>

<script>
function togglePassword(fieldId, el) {
    const input = document.getElementById(fieldId);
    const icon = el.querySelector("i");

    if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.replace("fa-eye-slash", "fa-eye");
    }
}
</script>
</body>
</html>
