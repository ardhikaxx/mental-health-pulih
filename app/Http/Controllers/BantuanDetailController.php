<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BantuanDetailController extends Controller
{
    public function darurat()
    {
        return view('bantuan.darurat');
    }

    public function keamanan()
    {
        return view('bantuan.keamanan');
    }

    public function pusatBantuan()
    {
        return view('bantuan.pusat-bantuan');
    }

    public function lapor()
    {
        return view('bantuan.lapor');
    }

    public function saran()
    {
        return view('bantuan.saran');
    }

    public function simpanLaporan(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
        ]);

        // Logic to save or send email
        return back()->with('success', 'Laporan Anda telah kami terima. Terima kasih atas laporannya.');
    }

    public function simpanSaran(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'pesan' => 'required|string',
        ]);

        // Logic to save or send email
        return back()->with('success', 'Terima kasih atas saran dan masukan Anda!');
    }
}
