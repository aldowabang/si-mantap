@extends('layout.main')
@section('content')
    <div class="az-content-label mg-b-5">Tambah Tahap Proyek</div>
    <p class="mg-b-20">Silakan isi form berikut untuk menambahkan tahap proyek.</p>
    <form action="{{ route('store-tahap') }}" method="POST">
        @csrf
        <input type="hidden" name="proyek_id" value="{{ $proyek_id->id }}">
        <input type="hidden" name="statusTahap" value="non-approval">
        <input type="hidden" name="wa" value="{{ $pengawas->whatsapp }}">
        <div class="form-group">
            <label for="namaTahap">Nama Tahap</label>
            <input type="text" class="form-control @error('namaTahap') is-invalid @enderror" id="namaTahap" name="namaTahap" value="{{ old('namaTahap') }}">
            @error('namaTahap')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" style="border-radius: 5px">Simpan Tahap</button>
        <a href="{{ route('proyek-monitoring-pengawas', $proyek_id->id) }}" class="btn btn-secondary" style="border-radius: 5px">Kembali</a>
    </form>
@endsection