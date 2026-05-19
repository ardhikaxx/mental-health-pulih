@extends('layouts.auth', ['title' => 'Register'])

@section('form')
    <h2 class="auth-title">Selamat Datang</h2>
    <p class="auth-subtitle">Mulai perjalanan pemulihanmu sekarang</p>

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Lengkap</label>
            <div class="input-box">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="name" placeholder="Masukkan nama" required>
            </div>
        </div>
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
                <input type="password" id="password" name="password" placeholder="Buat password" required>
                <i class="fa-solid fa-eye eye-icon" onclick="togglePassword('password')"></i>
            </div>
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <div class="input-box">
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                <i class="fa-solid fa-eye eye-icon" onclick="togglePassword('password_confirmation')"></i>
            </div>
        </div>
        <button type="submit" class="btn-submit">Daftar sekarang</button>
    </form>
    
    <div class="divider">atau daftar dengan</div>
    <a href="#" class="google-btn"><i class="fa-brands fa-google"></i> Google</a>

    <div class="auth-footer">
        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
    </div>

    <script>
        function togglePassword(id) {
            const p = document.getElementById(id);
            p.type = p.type === 'password' ? 'text' : 'password';
        }
    </script>
@endsection
