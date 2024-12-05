<?php

namespace App\Exports;

use App\Models\Tamu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon; // Ensure Carbon is imported

class RekapitulasiExport implements FromCollection, WithHeadings
{
    protected $tanggal1;
    protected $tanggal2;

    public function __construct($tanggal1, $tanggal2)
    {
        $this->tanggal1 = $tanggal1;
        $this->tanggal2 = $tanggal2;
    }

    public function collection()
    {
        // Query data between two dates
        return Tamu::whereBetween('tanggal', [$this->tanggal1, $this->tanggal2])
            ->orderBy('tanggal', 'desc')
            ->select([
                'tanggal', 'nama', 'nip', 'jabatan', 'instansi', 'nope', 'pejabat_yang_dituju', 'keperluan',
            ])
            ->get()
            ->map(function ($item) {
                // Format tanggal to the desired format using Carbon
                $item->tanggal = Carbon::parse($item->tanggal)->format('Y-m-d');
                return $item;
            });
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama',
            'NIP',
            'Jabatan',
            'Instansi',
            'Nomor HP / WA',
            'Pejabat Yang Dituju',
            'Keperluan',
        ];
    }
}
