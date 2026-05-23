<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TbPasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FirebaseAuthController extends Controller
{
    public function handleGoogleLogin(Request $request)
    {
        try {
            $idToken = $request->id_token;
            if (!$idToken) {
                return response()->json(['success' => false, 'message' => 'Token tidak ditemukan'], 400);
            }

            $auth = Firebase::auth();
            
            // Diagnostik: Log project ID dan cuplikan token
            Log::info('Google Login Diagnostic', [
                'project_id' => config('firebase.projects.app.credentials'),
                'token_preview' => substr($idToken, 0, 20) . '...',
            ]);

            // 1. Verifikasi Token dari Firebase
            // Menambahkan leeway (toleransi waktu) 5 menit untuk mengatasi perbedaan waktu server/client
            $verifiedIdToken = $auth->verifyIdToken($idToken, false, 300);
            $firebaseUser = $auth->getUser($verifiedIdToken->claims()->get('sub'));
            
            $email = $firebaseUser->email;
            $name = $firebaseUser->displayName;
            $photoUrl = $firebaseUser->photoUrl;

            // 2. Cari atau Buat User
            $user = User::where('email', $email)->first();

            if (!$user) {
                // Register sebagai Pasien Baru jika email belum terdaftar
                $user = User::create([
                    'nama_lengkap' => $name,
                    'email' => $email,
                    'password' => Hash::make(Str::random(16)),
                    'role' => 'pasien',
                    'status_akun' => 'aktif',
                    'foto_profil' => $photoUrl,
                ]);

                TbPasien::create([
                    'id_user' => $user->id_user,
                    'tanggal_daftar' => now()->toDateString(),
                    'status_pasien' => 'aktif',
                ]);
            } else {
                // Jika user ada tapi rolenya bukan pasien (opsional: tergantung kebijakan sistem)
                if ($user->role !== 'pasien') {
                    return response()->json([
                        'success' => false,
                        'message' => 'Email ini terdaftar sebagai ' . $user->role . '. Silakan gunakan login manual.',
                    ], 403);
                }
                
                // Update foto profil jika berubah dan belum ada foto manual (lokal)
                if ($photoUrl && $user->foto_profil !== $photoUrl) {
                    // Hanya update jika foto saat ini kosong atau juga merupakan URL (bukan path lokal)
                    if (!$user->foto_profil || filter_var($user->foto_profil, FILTER_VALIDATE_URL)) {
                        $user->update(['foto_profil' => $photoUrl]);
                    }
                }
            }

            // 3. Login-kan di Laravel
            Auth::login($user);

            return response()->json([
                'success' => true,
                'redirect' => route('dashboard'),
            ]);

        } catch (\Exception $e) {
            Log::error('Google Login Error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            $message = $e->getMessage();
            if (str_contains($message, 'invalid_grant')) {
                $message = 'Gagal autentikasi (invalid_grant). Pastikan jam komputer Anda sudah sinkron (akurat) dan file kredensial Firebase sudah benar.';
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal autentikasi Google: ' . $message,
            ], 401);
        }
    }
}
