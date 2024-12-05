<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mttamu extends Model
{
    use HasFactory;

    protected $table = 'ttamu';
    protected $fillable = ['tanggal', 'nama', 'nip', 'jabatan', 'instansi', 'nope', 'pejabat_yang_dituju', 'keperluan',];
}
