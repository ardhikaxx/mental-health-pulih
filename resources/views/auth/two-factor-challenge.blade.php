@extends('layouts.auth', ['title' => 'Verifikasi Keamanan'])

@section('form')
    <h2 class="auth-title">Verifikasi 2 Langkah</h2>
    <p class="auth-subtitle">Salin kode keamanan 4 digit di bawah ini untuk melanjutkan.</p>

    <div class="text-center mb-5 mt-4">
        <div class="code-display-container">
            @foreach(str_split((string)$code) as $digit)
                <div class="digit-box shadow-sm">
                    {{ $digit }}
                </div>
            @endforeach
        </div>
        <div class="small fw-bold text-uppercase opacity-50 tracking-widest mt-3 pulse-animation" style="letter-spacing: 2px; font-size: 10px; color: var(--primary-green);">
            Security Token Active
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 rounded-4 mb-4 small text-center" style="background: rgba(34, 197, 94, 0.1); color: #166534;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('two-factor.login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Kode Konfirmasi</label>
            <div class="input-box">
                <i class="fa-solid fa-shield-lock"></i>
                <input type="text" name="code" placeholder="Masukkan 4 digit di atas" required autofocus maxlength="4" autocomplete="off" style="letter-spacing: 5px; font-weight: 700; text-align: center; padding-left: 0;">
            </div>
            @error('code')
                <small style="color: #e53e3e; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn-submit">Verifikasi & Login</button>
    </form>

    <div class="divider">atau</div>
    
    <form action="{{ route('two-factor.resend') }}" method="POST">
        @csrf
        <button type="submit" class="google-btn" style="border: none; background: #f8fafc; cursor: pointer; width: 100%;">
            <i class="fa-solid fa-rotate"></i> Ganti Kode Baru
        </button>
    </form>

    <div class="auth-footer">
        Bermasalah dengan akun? <a href="{{ route('bantuan.index') }}">Hubungi Bantuan</a>
    </div>

    <style>
        .code-display-container {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 10px;
        }
        .digit-box {
            width: 54px;
            height: 64px;
            background: #fff;
            border: 2px solid var(--primary-green);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 800;
            color: var(--primary-green);
            transition: all 0.3s ease;
        }
        .digit-box:hover {
            transform: translateY(-5px);
            background: var(--bs-primary-bg-subtle);
            box-shadow: 0 10px 15px -3px rgba(0, 92, 52, 0.1);
        }
        .pulse-animation {
            animation: pulse-op 2s infinite;
        }
        @keyframes pulse-op {
            0% { opacity: 0.3; }
            50% { opacity: 0.7; }
            100% { opacity: 0.3; }
        }

        @media (max-width: 576px) {
            .code-display-container {
                gap: 8px;
            }
            .digit-box {
                width: 46px;
                height: 56px;
                font-size: 22px;
                border-radius: 10px;
            }
        }
    </style>
@endsection
