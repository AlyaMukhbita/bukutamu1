<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu; // Pastikan Anda memiliki model Tamu
use Maatwebsite\Excel\Facades\Excel; // Untuk ekspor data
use App\Exports\RekapitulasiExport; // File eksport data Excel
use App\Models\Mttamu; 

class RekapitulasiController extends Controller
{
    public function index()
    {
        // Tampilkan halaman rekapitulasi tanpa data (awal).
        return view('dashboard.rekapitulasi');
    }
   
    // Fungsi untuk menampilkan data tamu berdasarkan tanggal    
    public function tampil(Request $request)
    {
        if (!$request->isMethod('post')) {
            return redirect()->route('rekapitulasi.index');
        }

        $request->validate([
            'tanggal1' => 'required|date',
            'tanggal2' => 'required|date|after_or_equal:tanggal1',
        ]);
    
        $dataTamu = Mttamu::whereBetween('tanggal', [$request->tanggal1, $request->tanggal2])
            ->orderBy('tanggal', 'desc')
            ->get();
    
        return view('dashboard.rekapitulasi', [
            'dataTamu' => $dataTamu,
            'tanggal1' => $request->tanggal1,
            'tanggal2' => $request->tanggal2
        ]);
    }
    

    // Fungsi untuk mengekspor data ke file Excel
    public function export(Request $request)
    {
        $tanggal1 = $request->input('tanggal1');
        $tanggal2 = $request->input('tanggal2');

        // Menggunakan RekapitulasiExport untuk mengekspor data
        return Excel::download(new RekapitulasiExport($tanggal1, $tanggal2), 'rekapitulasi.xlsx');
    }
}

