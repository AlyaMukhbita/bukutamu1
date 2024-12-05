@extends('layout.menu')

@section('konten')

    <!-- Header Template -->
    <div class="header-template">
        <h1 class="text-center">Data Tamu</h1>
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
    <div class="action-container mb-3">
    <!-- Tombol Tambah Data -->
    <a href="{{ route('ttamu.tambah') }}" class="btn btn-outline-primary btn-sm tambah-data-btn" title="Tambah data">
        <i class="fa fa-plus-square"></i> &nbsp;Tambah Data
    </a>

    <!-- Form Pencarian -->
    <form action="{{ route('ttamu.index') }}" method="GET" class="search-form d-flex align-items-center">
        <div class="input-group">
            <input 
                type="text" 
                name="search" 
                class="form-control form-control-sm search-input" 
                placeholder="Cari Berdasarkan Data" 
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm search-button">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>
</div>


    <!-- Tabel Data Tamu -->
    <div class="table-container">
        <table class="table table-bordered table-hover mt-2">
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
                @if ($ttamu->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center">Data tidak ditemukan.</td>
                    </tr>
                @else
                    @foreach ($ttamu as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->tanggal ?? 'Tidak Ada' }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->nip ?? '-' }}</td>
                            <td>{{ $d->jabatan }}</td>
                            <td>{{ $d->instansi }}</td>
                            <td>{{ $d->nope }}</td>
                            <td>{{ $d->pejabat_yang_dituju }}</td>
                            <td>{{ $d->keperluan }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- JavaScript untuk menghilangkan notifikasi -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function fadeOutAlert(id, duration) {
                const alert = document.getElementById(id);
                if (alert) {
                    setTimeout(() => {
                        alert.style.opacity = 0;
                        setTimeout(() => alert.remove(), 600);
                    }, duration);
                }
            }

            fadeOutAlert('success-alert', 5000);
            fadeOutAlert('error-alert', 5000);
        });
    </script>

    <!-- CSS untuk styling tambahan -->
    <style>
        /* Styling untuk tombol dan form pencarian */
        .action-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

            /* Styling untuk Tombol Tambah Data */
    .tambah-data-btn {
        margin-right: 15px;
    }

        /* Styling Form Pencarian */
        .search-form {
        display: flex;
        align-items: center;
    }

 /* Styling Container */
 .search-container {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    /* Styling Form */
    .search-form .input-group {
        width: 300px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 25px;
        overflow: hidden;
    }

    /* Input Field */
    .search-input {
        border: none;
        padding: 10px;
        font-size: 14px;
        /* border-radius: 0; */
    }

    .search-input:focus {
        outline: none;
        box-shadow: none;
    }

    /* Button */
    .search-button {
        border: none;
        border-radius: 0;
        background-color: #007bff;
        color: #fff;
        padding: 10px 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease;
    }

    .search-button:hover {
        background-color: #0056b3;
    }


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

            .action-container {
            flex-direction: column;
            align-items: flex-start;
        }

        .tambah-data-btn {
            margin-bottom: 10px;
        }

        .search-form .input-group {
            width: 100%;
        }


            /* .table th, .table td {
                font-size: 12px;
            }

            .search-form input {
                width: 150px;
            } */
        }
    </style>

@endsection
