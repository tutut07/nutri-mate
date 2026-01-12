<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rekomendasi Makanan</title>

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

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email" required>

            <label for="password">Password</label>
            <div class="input-wrapper">
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>

                <span class="toggle-password" onclick="togglePassword('password', this)">
                    <i class="fa-solid fa-eye"></i>
                </span>
            </div>

            <button type="submit">Masuk</button>
        <a href="/" class="btn-home">Kembali ke Home</a>

        </form>
        <p class="text-center">
    <a href="{{ route('password.request') }}">Lupa password?</a>
</p>

        <p class="text-center">Belum punya akun? <a href="{{ url('/register') }}">Daftar di sini</a></p>
    </div>

    <script>
        function togglePassword(fieldId, el) {
            const input = document.getElementById(fieldId);
            const icon = el.querySelector("i");

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.add("fa-eye");
                icon.classList.remove("fa-eye-slash");
            }
        }
    </script>
</body>
</html>
