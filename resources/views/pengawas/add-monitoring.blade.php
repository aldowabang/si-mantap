@extends('layout.main')
@section('content')
    <div class="az-content-label mg-b-5">Tambah Monitoring Proyek</div>
    <p class="mg-b-20">Silakan isi form berikut untuk menambahkan monitoring proyek.</p>

    <form action="{{ route('store-monitoring') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="proyek_id" value="{{ $proyek_id }}">

        <div class="form-group">
            <label for="nama_monitoring">Nama Monitoring</label>
            <input type="text" class="form-control @error('nama_monitoring') is-invalid @enderror" id="nama_monitoring" name="nama_monitoring"  value="{{ old('nama_monitoring') }}">
            @error('nama_monitoring')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi_monitoring">Deskripsi Monitoring</label>
            <textarea class="form-control @error('deskripsi_monitoring') is-invalid
            @enderror" id="deskripsi_monitoring" name="deskripsi_monitoring" rows="3" ></textarea>
            @error('deskripsi_monitoring')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="tahap_monitoring">Tahap</label>
            <select class="form-control @error('tahap_monitoring') is-invalid @enderror" id="tahap_monitoring" name="tahap_monitoring">
            <option value="">-- Pilih Tahap --</option>
            @foreach($tahaps as $tahap)
                @if($tahap->proyek_id == $proyek_id && $tahap->statusTahap === 'non-approval')
                <option value="{{ $tahap->id }}" {{ old('tahap_monitoring') == $tahap->id ? 'selected' : '' }}>
                    {{ $tahap->namaTahap }}
                </option>
                @endif
            @endforeach
            </select>
            @error('tahap_monitoring')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" style="border-radius: 5px">Simpan Monitoring</button>
        <a href="" class="btn btn-secondary" style="border-radius: 5px">Kembali</a>
    </form>
@endsection