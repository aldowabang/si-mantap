@extends('layout.main')

@section('content')
<div class="az-content-label mg-b-5">Edit Proyek</div>
<p class="mg-b-20">Silakan ubah detail proyek di bawah ini.</p>
<form action="{{ route('admin-update-proyek', $proyek->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
  
    <div class="row row-sm">
        <div class="col-lg">
            <label>Nama Proyek</label>
            <input class="form-control @error('nameProyek') is-invalid @enderror" type="text" name="nameProyek" placeholder="Nama Proyek" value="{{ old('nameProyek', $proyek->nameProyek) }}">
            @error('nameProyek')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div><!-- col -->
        <div class="col-lg">
            <label>Lokasi</label>
            <input class="form-control @error('lokasi') is-invalid @enderror" type="text" name="lokasi" placeholder="Lokasi Proyek" value="{{ old('lokasi', $proyek->lokasi) }}">
            @error('lokasi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div><!-- col -->
    </div><!-- row -->
    
    <div class="row row-sm mg-t-20">
        <div class="col-lg">
            <label>Anggaran (Rp)</label>
            <input class="form-control @error('nilai') is-invalid @enderror" type="number" name="nilai" placeholder="Nilai Proyek" value="{{ old('nilai', $proyek->nilai) }}">
            @error('nilai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div><!-- col -->
        <div class="col-lg">
            <label>Status</label>
            <select class="form-control @error('status') is-invalid @enderror" name="status">
                <option value="" disabled selected>Pilih Status</option>
                <option value="non-active" {{ old('status', $proyek->status) == 'non-active' ? 'selected' : '' }}>Tidak Aktif</option>
                <option value="active" {{ old('status', $proyek->status) == 'active' ? 'selected' : '' }}>Aktif</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div><!-- col -->
    </div><!-- row -->

    <div class="row row-sm mg-t-20">
        <div class="col-lg">
            <label>Jenis Proyek</label>
            <select class="form-control @error('jenis') is-invalid @enderror" name="jenis">
                <option value="" disabled selected>Pilih Jenis Proyek</option>
                <option value="konstruksi" {{ old('jenis', $proyek->jenis) == 'konstruksi' ? 'selected' : '' }}>Konstruksi</option>
                <option value="pengadaan" {{ old('jenis', $proyek->jenis) == 'pengadaan' ? 'selected' : '' }}>Pengadaan</option>
                <option value="lainnya" {{ old('jenis', $proyek->jenis) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
            @error('jenis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div><!-- col -->
        <div class="col-lg">
            <label>Pengawas</label>
            <select class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                <option value="" disabled selected>Pilih Pengawas</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $proyek->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div><!-- col -->
    </div><!-- row -->

    <div class="row row-sm mg-t-20">
        <div class="col-lg">
            <label>Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3" placeholder="Deskripsi Proyek">{{ old('deskripsi', $proyek->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div><!-- col -->
    </div><!-- row -->
    <div class="row row-sm mg-t-20">
        <div class="col-lg">
            <label>Gambar Proyek</label>
            <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar" accept="image/*">
            @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div><!-- col -->
        <div class="col-lg">
            <label>Dokumen Proyek</label>
            <input type="file" class="form-control @error('file_path') is-invalid @enderror" name="file_path" accept=".pdf,.doc,.docx">
            @error('file_path')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div><!-- col -->
    </div><!-- row -->
    <div class="row row-sm mg-t-20">
        <div class="col-lg">
            <label>Gambar Saat Ini</label>
            @if($proyek->gambar)
                <img src="{{ asset('storage/' . $proyek->gambar) }}" alt="Gambar Proyek" class="img-fluid" style="max-height: 200px; object-fit: cover;">
            @else
                <p>Tidak ada gambar saat ini.</p>
            @endif
        </div><!-- col -->
        <div class="col-lg">
            <label>Dokumen Saat Ini</label>
            @if($proyek->file_path)
                <a href="{{ asset('storage/' . $proyek->file_path) }}" target="_blank" class="btn btn-secondary">Lihat Dokumen</a>
            @else
                <p>Tidak ada dokumen saat ini.</p>
            @endif
        </div><!-- col -->
    </div><!-- row -->
    

    <div class="row row-sm mg-t-20">
        <div class="col-lg">
            <button type="submit" class="btn btn-primary">Update Proyek</button>
        </div><!-- col -->
    </div><!-- row -->
</form>

@endsection