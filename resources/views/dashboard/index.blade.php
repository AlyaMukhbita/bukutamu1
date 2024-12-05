@extends('layout.menu')

@section('konten')

    <!-- Header Template -->
    <div class="header-template">
        <h1 class="text-center">Data Tamu Harian</h1>
        <hr>
    </div>

    <!-- Menampilkan notifikasi -->
    @if(session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" id="error-alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- Container untuk tombol tambah dan rekapitulasi -->
    <div class="d-flex justify-content-start mb-3" style="margin-bottom: 20px;">
        <form method="GET" action="/dashboard">
        @csrf
            <label for="Tanggal"></label>
            <input type="date" name="tanggal">

            <label for="submit"></label>
            <input type="submit">
        </form>
                <!-- Tombol Rekapitulasi Tamu -->
                <a href="{{ route('rekapitulasi.index') }}" class="btn btn-success btn-sm ml-3" title="Rekapitulasi Tamu">
            <i class="icon ion-ios-paper"></i> &nbsp;Rekapitulasi Tamu
        </a>
    </div>
    <div class="d-flex justify-content-start mb-3" style="margin-bottom: 20px;">
        Data tamu pada tanggal ({{ $sekarang }})
    </div>

    <!-- Tabel Data Tamu -->
    <div class="table-container">
		
    <table class="table table-bordered table-hover mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Jabatan</th>
                    <th>Instansi</th>
                    <th>No HP / WA</th>
                    <th>Pejabat Yang Dituju</th>
                    <th>Keperluan</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($ttamu as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->tanggal ?? 'Tidak Ada' }}</td>
                        <td>{{ $d->nama }}</td>
                        <td><?php if($d->nip == null){ ?> - <?php }else{ ?> {{ $d->nip }} <?php } ?></td>
                        <td>{{ $d->jabatan }}</td>
                        <td>{{ $d->instansi }}</td>
                        <td>{{ $d->nope }}</td>
                        <td>{{ $d->pejabat_yang_dituju }}</td>
                        <td>{{ $d->keperluan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- JavaScript untuk menghilangkan notifikasi -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mengatur durasi notifikasi
            function fadeOutAlert(id, duration) {
                const alert = document.getElementById(id);
                if (alert) {
                    setTimeout(() => {
                        alert.style.opacity = 0;
                        setTimeout(() => alert.remove(), 600); // Waktu untuk menghapus setelah fade out
                    }, duration);
                }
            }

            fadeOutAlert('success-alert', 5000); // 5 detik untuk notifikasi sukses
            fadeOutAlert('error-alert', 5000); // 5 detik untuk notifikasi error
        });
    </script>

    <!-- CSS untuk Tombol Transparan dan Styling -->
    <style>
    /* Atur header tabel agar tetap rata tengah */
    .table th {
        text-align: center;
        vertical-align: middle;
    }

    /* Atur isi tabel agar rata kiri */
    .table td {
        text-align: left;
        vertical-align: middle;
    }

    /* Styling tambahan untuk tabel */
    .table-container {
        margin-top: 20px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .thead-dark th {
        background-color: #343a40;
        color: #fff;
    }

    .table th, .table td {
        padding: 10px;
    }

    /* Responsif untuk tampilan kecil */
    @media (max-width: 768px) {
        .table th, .table td {
            font-size: 12px;
        }
    }
</style>


@endsection
   