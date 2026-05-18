<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSkrining;
use Illuminate\Http\Request;

class SkriningController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->toString();

        $skrining = JenisSkrining::withCount('pertanyaan')
            ->when($search, function ($query) use ($search) {
                $query->where('nama_skrining', 'like', "%{$search}%")
                    ->orWhere('jenis_penyakit', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.skrining.index', compact('skrining', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_skrining' => 'required|string|max:255',
            'jenis_penyakit' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'panduan_pengelolaan' => 'nullable|string',
            'status' => 'required|in:draft,publish',
        ]);

        JenisSkrining::create($validated + [
            'dibuat_oleh' => auth()->id(),
        ]);

        return back()->with('success', 'Jenis skrining berhasil ditambahkan.');
    }

    public function update(Request $request, JenisSkrining $skrining)
    {
        $validated = $request->validate([
            'nama_skrining' => 'required|string|max:255',
            'jenis_penyakit' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'panduan_pengelolaan' => 'nullable|string',
            'status' => 'required|in:draft,publish',
        ]);

        $skrining->update($validated);

        return back()->with('success', 'Jenis skrining berhasil diperbarui.');
    }

    public function destroy(JenisSkrining $skrining)
    {
        $skrining->delete();

        return back()->with('success', 'Jenis skrining berhasil dihapus.');
    }
}
