<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mttamu; 

class Cdashboard extends Controller
{
    public function index(Request $request)
    {
        if (!$request->tanggal) {
            $sekarang = date('Y-m-d');
        }else{
            $sekarang = $request->tanggal;
        }
        $ttamu = Mttamu::where('tanggal', '=', $sekarang)->get();
        return view('dashboard.index', compact('ttamu'), ['sekarang' => $sekarang]);
    }


}
