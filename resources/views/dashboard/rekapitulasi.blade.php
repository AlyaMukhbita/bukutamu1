@extends('layout.menu')

@section('konten')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4 mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Pengunjung</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('rekapitulasi.tampil') }}" class="text-center">
                    @csrf
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Dari Tanggal</label>
                                <input class="form-control" type="date" name="tanggal1" value="{{ old('tanggal1', date('Y-m-d')) }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input class="form-control" type="date" name="tanggal2" value="{{ old('tanggal2', date('Y-m-d')) }}" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-2">
                            <button class="btn btn-primary form-control btn-sm text-white" type="submit" style="background-color: #007bff; border: none;">
                                <i class="fa fa-search"></i> Tampilkan
                            </button>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-danger form-control btn-sm text-white" style="background-color: #dc3545; border: none;">
                                <i class="fa fa-backward"></i> Kembali
                            </a>
                        </div>
                    </div>
                </form>

                @if (isset($dataTamu))
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Jabatan</th>
                                    <th>Instansi</th>
                                    <th>Nomor HP / WA</th>
                                    <th>Pejabat Yang Dituju</th>
                                    <th>Keperluan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataTamu as $index => $tamu)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $tamu->tanggal }}</td>
                                        <td>{{ $tamu->nama }}</td>
                                        <td>{{ $tamu->nip ?? '-' }}</td>
                                        <td>{{ $tamu->jabatan }}</td>
                                        <td>{{ $tamu->instansi }}</td>
                                        <td>{{ $tamu->nope }}</td>
                                        <td>{{ $tamu->pejabat_yang_dituju }}</td>
                                        <td>{{ $tamu->keperluan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <center>
                        <form method="POST" action="{{ route('rekapitulasi.export') }}">
                            @csrf
                            <input type="hidden" name="tanggal1" value="{{ $tanggal1 ?? old('tanggal1') }}">
                            <input type="hidden" name="tanggal2" value="{{ $tanggal2 ?? old('tanggal2') }}">
                            <button type="submit" class="btn btn-success btn-sm text-white">
                                <i class="fa fa-download"></i> Export Data Excel
                            </button>
                        </form>
                        </center>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

