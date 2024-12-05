<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;

    // Nama tabel jika tidak mengikuti konvensi penamaan
    protected $table = 'ttamu';  // Pastikan nama tabel benar

    // Kolom 'tanggal' bertipe tanggal atau datetime
    protected $dates = ['tanggal'];  // Pastikan kolom tanggal di database bertipe DATE atau DATETIME

    // Kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'tanggal', 'nama', 'nip', 'jabatan', 'instansi', 'nope', 'pejabat_yang_dituju', 'keperluan'
    ];
}