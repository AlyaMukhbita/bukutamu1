<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mttamu; 
// use Illuminate\Support\Facades\Auth;

class Cttamu extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        // Filter data berdasarkan kriteria pencarian
        $ttamu = Mttamu::when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('tanggal', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('jabatan', 'like', "%{$search}%")
                  ->orWhere('instansi', 'like', "%{$search}%")
                  ->orWhere('nope', 'like', "%{$search}%")
                  ->orWhere('pejabat_yang_dituju', 'like', "%{$search}%")
                  ->orWhere('keperluan', 'like', "%{$search}%");
            });
        })->orderBy('tanggal', 'desc')->get();
    
        // Jika ini untuk tampilan tamu
        if ($request->has('view') && $request->input('view') === 'rekapitulasi') {
            $tamuByInstansi = Mttamu::select('instansi', \DB::raw('count(*) as total'))
                ->groupBy('instansi')
                ->get();
    
            $tamuByPejabat = Mttamu::select('pejabat_yang_dituju', \DB::raw('count(*) as total'))
                ->groupBy('pejabat_yang_dituju')
                ->get();
    
            $totalTamu = Mttamu::count();
    
            return view('rekapitulasi.index', compact('tamuByInstansi', 'tamuByPejabat', 'totalTamu'));
        }
    
        return view('ttamu.index', compact('ttamu'));
    }
    

    public function tambah()
    {
        return view('ttamu.tambah');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            // 'tanggal'                  => 'required|date',
            'nama'                     => 'required|string|max:255',
            'nip'                      => 'required|string|max:20',
            'jabatan'                  => 'required|string|max:255',
            'instansi'                 => 'required|string|max:255',
            'nope'                     => 'required|string|digits_between:10,15|numeric',
            'keperluan'                => 'required|string|max:255',
        ]);

        $ttamu = new Mttamu();
        $ttamu->tanggal                 = now();
        $ttamu->nama                    = $request->nama;
        $ttamu->nip                     = $request->nip;
        $ttamu->jabatan                 = $request->jabatan;
        $ttamu->instansi                = $request->instansi;
        $ttamu->nope                    = $request->nope;
        $ttamu->pejabat_yang_dituju     = $request->pejabat_yang_dituju;
        $ttamu->keperluan               = $request->keperluan;
        $ttamu->save();

        // // Simpan data ke database ini *ga perlu
        // Mttamu::create($validatedData);

        // Redirect ke halaman lain dengan pesan sukses
        return redirect()->route('ttamu.index')->with('success', 'Data berhasil disimpan');
    }

    public function ubah(string $id)
    {
        $ttamu = Mttamu::where('id', $id)->first();
        return view('ttamu.ubah', compact('ttamu'));
    }

    public function update(Request $request, string $id)
    {
              // Find the existing by id
              $ttamu = Mttamu::where('id', $id)->first();

              if (!$ttamu) {
                  return redirect()->route('ttamu.index')->with('error', 'Data not found');
              }
      
              // Update the fields
              $ttamu->tanggal               = $request->tanggal;
              $ttamu->nama                  = $request->nama;
              $ttamu->nip                   = $request->nip;
              $ttamu->jabatan               = $request->jabatan;
              $ttamu->instansi              = $request->instansi;
              $ttamu->nope                  = $request->nope;
              $ttamu->pejabat_yang_dituju   = $request->pejabat_yang_dituju;
              $ttamu->keperluan             = $request->keperluan;
              $ttamu->save();
      
              return redirect()->route('ttamu.index')->with('success', 'Data berhasil diperbarui');
    }


    public function hapus(string $id)
    {
        //
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required',
    //         'password' => 'required',
    //     ]);

    //     if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
    //         return redirect()->route('home');
    //     }

    //     return back()->withErrors([
    //         'username' => 'Invalid credentials.',
    //     ])->withInput();
    // }

    public function rekapitulasi()
    {
        $totalTamu = Tamu::count(); // Total tamu
        $tamuByInstansi = Tamu::select('instansi', \DB::raw('count(*) as total'))
                                ->groupBy('instansi')
                                ->get(); // Rekap berdasarkan instansi

        $tamuByPejabat = Tamu::select('pejabat_yang_dituju', \DB::raw('count(*) as total'))
                            ->groupBy('pejabat_yang_dituju')
                            ->get(); // Rekap berdasarkan pejabat yang dituju

        return view('rekapitulasi', compact('totalTamu', 'tamuByInstansi', 'tamuByPejabat'));
    }

}