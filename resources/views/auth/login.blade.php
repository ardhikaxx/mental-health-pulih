@extends('layouts.auth', ['title' => 'Login'])

@section('form')
    <h2 class="auth-title">Selamat Datang Kembali</h2>
    <p class="auth-subtitle">Silakan login untuk melanjutkan perjalananmu</p>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Email</label>
            <div class="input-box">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" placeholder="Masukkan email" required>
            </div>
        </div>
        <div class="form-group">
            <label>Password</label>
            <div class="input-box">
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                <i class="fa-solid fa-eye eye-icon" id="toggle-password" onclick="togglePassword('password', 'toggle-password')"></i>
            </div>
            <div style="text-align: right; margin-top: 8px;">
                <a href="{{ route('password.request') }}" style="color: #005c34; font-size: 13px; font-weight: 600; text-decoration: none;">Reset Password?</a>
            </div>
        </div>
        <button type="submit" class="btn-submit">Login</button>
    </form>
    
    <div class="divider">atau login dengan</div>
    <a href="#" class="google-btn"><i class="fa-brands fa-google"></i> Google</a>

    <div class="auth-footer">
        Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonColor: '#005c34',
            });
        @endif

        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
