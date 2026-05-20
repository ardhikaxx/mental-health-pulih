<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\TwoFactorCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function showChallenge(Request $request)
    {
        $userId = $request->session()->get('2fa_user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::findOrFail($userId);

        return view('auth.two-factor-challenge', [
            'code' => $user->two_factor_code
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $userId = $request->session()->get('2fa_user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::findOrFail($userId);

        if ($user->two_factor_code !== $request->code || $user->two_factor_expires_at->isPast()) {
            return back()->withErrors(['code' => 'Kode keamanan tidak valid atau telah kedaluwarsa.']);
        }

        // Reset code
        $user->update([
            'two_factor_code' => null,
            'two_factor_expires_at' => null,
        ]);

        Auth::login($user, $request->session()->get('2fa_remember', false));

        $request->session()->forget(['2fa_user_id', '2fa_remember']);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function resend(Request $request)
    {
        $userId = $request->session()->get('2fa_user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::findOrFail($userId);

        $code = rand(1000, 9999);
        $user->update([
            'two_factor_code' => $code,
            'two_factor_expires_at' => now()->addMinutes(10),
        ]);

        return back()->with('success', 'Kode keamanan baru telah dihasilkan.');
    }
}
