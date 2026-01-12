    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register - Rekomendasi Makanan</title>
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    </head>
    <body>
        <div class="container">
            <h2>Daftar Akun</h2>

            @if(session('error'))
                <p class="error">{{ session('error') }}</p>
            @endif

            @if(session('success'))
                <p style="color: green; text-align:center;">{{ session('success') }}</p>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <label for="name">Nama Lengkap</label>
    <input type="text" id="name" name="name" placeholder="Masukkan nama"
        required oninput="this.value = this.value.replace(/[0-9]/g, '')">


                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email" required>

                <label for="password">Password</label>
    <div class="input-wrapper">
        <input type="password" name="password" id="password" placeholder="Masukkan password" required>

        <span class="toggle-password" onclick="togglePassword('password', this)">
            <i class="fa-solid fa-eye"></i>
        </span>
    </div>
    <label for="password_confirmation">Konfirmasi Password</label>

    <div class="input-wrapper">
        <input type="password" name="password_confirmation" id="password_confirmation"
            placeholder="Ulangi password" required>

        <span class="toggle-password" onclick="togglePassword('password_confirmation', this)">
            <i class="fa-solid fa-eye"></i>
        </span>
    </div>
                <button type="submit">Daftar</button>
            </form>

            <p class="text-center">Sudah punya akun? <a href="{{ url('/login') }}">Login di sini</a></p>
        </div>
        <script>
    function togglePassword(fieldId, el) {
        const input = document.getElementById(fieldId);
        const icon = el.querySelector('i');

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
