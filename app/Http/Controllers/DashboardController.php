<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Notification;
use App\Models\PesanKeluar;
use App\Models\PesanMasuk;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{

    public function dashboard()
    {
        $total_surat_masuk = PesanMasuk::where('is_active', 1)->count();
        $total_surat_keluar = PesanKeluar::where('is_active', 1)->count();
        $total_disposisi = Disposisi::count();
        // menghitung surat yang belum didisposisi
        $total_surat_belum_disposisi = 0;
        $pesan_masuk = PesanMasuk::where('is_active', 1)->get();
        // ambil relasi dngan disposisi, jika belum ada disposisi maka belum didisposisi, dan buat variablenya
        foreach ($pesan_masuk as $key => $value) {
            if ($value->disposisi->isEmpty()) {
                $total_surat_belum_disposisi++;
            }
        }

        return view('user.dashboard', compact('total_surat_masuk', 'total_surat_keluar', 'total_disposisi', 'total_surat_belum_disposisi'));
    }
}
