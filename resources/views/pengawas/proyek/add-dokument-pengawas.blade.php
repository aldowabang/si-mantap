@extends('layout.main')
@section('content')
    <div class="az-content-label mg-b-5">Tambah Dokument Pengawas</div>
    <p class="mg-b-20">Silakan isi form berikut untuk menambahkan dokument pengawas.</p>
    <form action="{{ route('store-dokument-pengawas') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="monitoring_id" value="{{ $monitoring->id }}">


        <div class="form-group">
            <label for="namaDokumen">Nama Dokumen</label>
            <input type="text" class="form-control @error('namaDokumen') is-invalid @enderror" id="namaDokumen" name="namaDokumen" value="{{ old('namaDokumen') }}">
            @error('namaDokumen')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="file_path_dokument">File Dokumen</label>
            <input type="file" class="form-control-file @error('file_path_dokument') is-invalid @enderror" id="file_path_dokument" name="file_path_dokument">
            @error('file_path_dokument')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="deskripsi_dokument">Deskripsi Dokumen</label>
            <textarea class="form-control @error('deskripsi_dokument') is-invalid @enderror" id="deskripsi_dokument" name="deskripsi_dokument" rows="3">{{ old('deskripsi_dokument') }}</textarea>
            @error('deskripsi_dokument')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary" style="border-radius: 5px">Simpan Dokument</button>
        <a href="{{ route('cek-dokument-pengawas', $monitoring->id) }}" class="btn btn-secondary" style="border-radius: 5px">Kembali</a></a>
    </form>
@endsection