@extends('layout.main')
@section('content')
    <div class="az-content-label mg-b-5">Edit Dokument Pengawas</div>
    <p class="mg-b-20">Silakan ubah informasi dokument pengawas berikut.</p>
    <form action="{{ route('update-dokument-pengawas', $dokument->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="monitoring_id" value="{{ $dokument->monitoring_id }}">
        <div class="form-group">
            <label for="namaDokumen">Nama Dokumen</label>
            <input type="text" class="form-control @error('namaDokumen') is-invalid @enderror" id="namaDokumen" name="namaDokumen" value="{{ old('namaDokumen', $dokument->namaDokumen) }}">
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
            @if($dokument->file_path_dokument)
                <p class="mt-2">Dokumen saat ini: 
                    <a href="{{ asset('storage/' . $dokument->file_path_dokument) }}" target="_blank">
                        <img src="{{ asset('storage/' . $dokument->file_path_dokument) }}" alt="Dokumen" style="max-height: 100px;">
                    </a>
                </p>
            @endif
        </div>
        <div class="form-group">
            <label for="deskripsi_dokument">Deskripsi Dokumen</label>
            <textarea class="form-control @error('deskripsi_dokument') is-invalid @enderror" id="deskripsi_dokument" name="deskripsi_dokument" rows="3">{{ old('deskripsi_dokument', $dokument->deskripsi_dokument) }}</textarea>
            @error('deskripsi_dokument')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>  
        <button type="submit" class="btn btn-primary" style="border-radius: 5px">Update Dokument</button>
        <a href="{{ route('cek-dokument-pengawas', $dokument->monitoring_id) }}" class="btn btn-secondary" style="border-radius: 5px">Kembali</a>
    </form>
@endsection