@extends('layout.menu')

@section('konten')

    <form method="POST" action="{{ route('ttamu.simpan') }}">
        @csrf
        <!-- <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <span style="color:red">
            @error('tanggal')
                {{ $message }}
            @enderror
        </span> -->

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <span style="color:red">
            @error('nama')
                {{ $message }}
            @enderror
        </span>

        <div class="form-group">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" required>
        </div>
        <span style="color:red">
            @error('nip')
                {{ $message }}
            @enderror
        </span>

        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control" required>
        </div>
        <span style="color:red">
            @error('jabatan')
                {{ $message }}
            @enderror
        </span>

        <div class="form-group">
            <label>Instansi</label>
            <input type="text" name="instansi" class="form-control" required>
        </div>
        <span style="color:red">
            @error('instansi')
                {{ $message }}
            @enderror
        </span>

        <div class="form-group">
            <label>Nomor HP / WA</label>
            <input type="text" name="nope" class="form-control" required>
        </div>
        <span style="color:red">
            @error('nope')
                {{ $message }}
            @enderror
        </span>

        <div class="form-group">
        <label for="pejabat_yang_dituju">Pejabat Yang Dituju</label>
    <select class="form-control" id="pejabat_yang_dituju" name="pejabat_yang_dituju">
        <option value="" disabled selected hidden></option>
        <option value="Kepala Dinas">Kepala Dinas</option>
        <option value="Sekretaris">Sekretaris</option>
        <option value="Kepala Bidang Pengelolaan Aplikasi Informatika">Kepala Bidang Pengelolaan Aplikasi Informatika</option>
        <option value="Kepala Bidang Statistik">Kepala Bidang Statistik</option>
        <option value="Kepala Bidang Pengelolaan Informasi dan Komunikasi Publik">Kepala Bidang Pengelolaan Informasi dan Komunikasi Publik</option>
        <option value="Lainnya">Lainnya</option>
        <!-- Add more options as needed -->
    </select>
    </div>

    <div class="form-group">
            <label>Keperluan</label>
            <input type="text" name="keperluan" class="form-control" required>
        </div>
        <span style="color:red">
            @error('keperluan')
                {{ $message }}
            @enderror
        </span>

        <div>
            <button type="submit" class="btn btn-primary btn-sm" title="Simpan data"><i class="fa fa-save"></i> &nbsp; Simpan
                Data</button>
            <a href="{{ route('ttamu.index') }}" class="btn btn-danger btn-sm" title="Kembali"><i
                    class="fa fa-arrow-left"></i> &nbsp;Kembali</a>
        </div>
    </form>
@endsection