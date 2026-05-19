<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\TbPsikolog;
use App\Models\TbPasien;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $role = $user->role;
        $view = $role === 'admin' ? 'admin.profile.edit' : 
               ($role === 'psikolog' ? 'psikolog.profile.edit' : 'pasien.profile.edit');

        $data = ['user' => $user];

        if ($role === 'psikolog') {
            $data['psikolog'] = TbPsikolog::where('id_user', $user->id_user)->first();
        } elseif ($role === 'pasien') {
            $data['pasien'] = TbPasien::where('id_user', $user->id_user)->first();
        }

        return view($view, $data);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Handle role-specific fields
        if ($user->role === 'psikolog') {
            $psikologData = $request->validate([
                'spesialisasi' => ['nullable', 'string', 'max:255'],
                'nomor_sipa' => ['nullable', 'string', 'max:50'],
                'pendidikan' => ['nullable', 'string', 'max:255'],
                'pengalaman' => ['nullable', 'integer', 'min:0'],
                'bio' => ['nullable', 'string'],
            ]);
            TbPsikolog::where('id_user', $user->id_user)->update($psikologData);
        } elseif ($user->role === 'pasien') {
            $pasienData = $request->validate([
                'umur' => ['nullable', 'integer', 'min:1'],
            ]);
            TbPasien::where('id_user', $user->id_user)->update($pasienData);
        }

        $role = $user->role;
        $target = $role === 'admin' ? route('admin.profile.edit') : 
                 ($role === 'psikolog' ? route('psikolog.profile.edit') : route('pasien.profile.edit'));

        return Redirect::to($target)->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
