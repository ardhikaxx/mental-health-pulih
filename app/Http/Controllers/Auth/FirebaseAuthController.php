<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TbPasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Str;

class FirebaseAuthController extends Controller
{
    public function handleGoogleLogin(Request $request)
    {
        try {
            $idToken = $request->id_token;
            $auth = Firebase::auth();
            
            // 1. Verifikasi Token dari Firebase
            $verifiedIdToken = $auth->verifyIdToken($idToken);
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
                
                // Update foto profil jika berubah
                if ($photoUrl && $user->foto_profil !== $photoUrl) {
                    $user->update(['foto_profil' => $photoUrl]);
                }
            }

            // 3. Login-kan di Laravel
            Auth::login($user);

            return response()->json([
                'success' => true,
                'redirect' => route('dashboard'),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal autentikasi Google: ' . $e->getMessage(),
            ], 401);
        }
    }
}
