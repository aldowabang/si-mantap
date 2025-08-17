@extends('layout.main')
@section('content')
<div class="az-content-label mg-b-5">Tambah Proyek</div>
<p class="mg-b-20">Silakan isi form berikut untuk menambahkan proyek baru.</p>
    <form action="{{ route('admin-store-proyek') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row row-sm">
            <div class="col-lg">
            <label>Nama Proyek</label>
            <input class="form-control @error('nameProyek') is-invalid @enderror" type="text" name="nameProyek" placeholder="Nama Proyek" value="{{ old('nameProyek') }}">
            @error('nameProyek')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div><!-- col -->
            <div class="col-lg">
            <label>Lokasi</label>
            <input class="form-control @error('lokasi') is-invalid @enderror" type="text" name="lokasi" placeholder="Lokasi Proyek" value="{{ old('lokasi') }}">
            @error('lokasi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div><!-- col -->
        </div><!-- row -->
        
        <div class="row row-sm mg-t-20">
            <div class="col-lg">
            <label>Anggaran (Rp)</label>
            <input class="form-control @error('nilai') is-invalid @enderror" type="number" name="nilai" placeholder="nilai Proyek" value="{{ old('nilai') }}">
            @error('nilai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div><!-- col -->
            <div class="col-lg">
            <label>Status</label>
            <select class="form-control @error('status') is-invalid @enderror" name="status">
                <option value="" disabled selected>Pilih Status</option>
                <option value="non-active" {{ old('status') == 'non-active' ? 'selected' : '' }}>Tidak Aktif</option>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div><!-- col -->
        </div><!-- row -->
        
        <div class="row row-sm mg-t-20">
            <div class="col-lg">
            <label>Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="3" placeholder="deskripsi Proyek">{{ old('deskripsi') }}</textarea>
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
                <label>User Pengawas</label>
                <select class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                    <option value="" disabled selected>Pilih User Pengawas</option>
                    @foreach($users as $peng)
                        <option value="{{ $peng->id }}" {{ old('user_id') == $peng->id ? 'selected' : '' }}>{{ $peng->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div><!-- col -->
            <div class="col-lg">
                <label>Jenis Proyek</label>
                <select class="form-control @error('jenis') is-invalid @enderror" name="jenis">
                    <option value="" disabled selected>Pilih Jenis Proyek</option>
                    <option value="konstruksi" {{ old('jenis') == 'konstruksi' ? 'selected' : '' }}>Konstruksi</option>
                    <option value="pengadaan" {{ old('jenis') == 'pengadaan' ? 'selected' : '' }}>Pengadaan</option>
                    <option value="lainnya" {{ old('jenis') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('jenis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div><!-- col -->
        </div><!-- row -->
        <div class="row row-sm mg-t-20">
            <div class="col-lg">
                <label for="tender_id">Pemegang Tender</label>
                <select class="form-control @error('tender_id') is-invalid @enderror" name="tender_id">
                    <option value="" disabled selected>Pilih Pemegang Tender</option>
                    @foreach($tenders as $tender)
                        <option value="{{ $tender->id }}" {{ old('tender_id') == $tender->id ? 'selected' : '' }}>{{ $tender->name }}</option>
                    @endforeach
                </select>
                @error('tender_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div><!-- col -->
        </div>
        <div class="row row-sm mg-t-20 mb-10">
            <div class="col-lg">
                <button type="submit" class="btn btn-primary">Tambah Proyek</button>
            </div><!-- col -->
        </div><!-- row -->
    </form>
@endsection 