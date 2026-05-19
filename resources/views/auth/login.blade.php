@extends('layouts.auth', ['title' => 'Login'])

@section('form')
    <h2 class="auth-title">Selamat Datang Kembali <i class="fa-solid fa-hand"></i></h2>
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
                <i class="fa-solid fa-eye eye-icon" onclick="togglePassword('password')"></i>
            </div>
        </div>
        <button type="submit" class="btn-submit">Login</button>
    </form>
    
    <div class="divider">atau login dengan</div>
    <a href="#" class="google-btn"><i class="fa-brands fa-google"></i> Google</a>

    <div class="auth-footer">
        Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
    </div>

    <script>
        function togglePassword(id) {
            const p = document.getElementById(id);
            p.type = p.type === 'password' ? 'text' : 'password';
        }
    </script>
@endsection
