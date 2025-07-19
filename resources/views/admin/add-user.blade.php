@extends('layout.main')
@section('content')
<div class="az-content-label mt-2">Tambah Pengguna</div>
<p class="mg-b-20">Silakan isi form berikut untuk menambahkan pengguna baru.</p>
<form action="{{ route('admin-store') }}" method="POST">
    @csrf
    <div class="row row-sm">
        <div class="col-lg">
            <label>Nama</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" placeholder="Nama Pengguna">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div><!-- col -->
        <div class="col-lg">
            <label>Email</label>
            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Email Pengguna">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div><!-- col -->
    </div><!-- row -->
    <div class="row row-sm mg-t-20">
        <div class="col-lg">
            <label>Role</label>
            <select class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}">
                <option value="" disabled selected>Pilih Role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="tender" {{ old('role') == 'tender' ? 'selected' : '' }}>Tender</option>
                <option value="pengawas" {{ old('role') == 'pengawas' ? 'selected' : '' }}>Pengawas</option>
            </select>
            @error('role')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div><!-- col -->
    </div><!-- row -->
    <div class="row row-sm mg-t-20">
        <div class="col-lg">
            <label>WhatsApp</label>
            <input class="form-control @error('whatsapp') is-invalid @enderror" type="text" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="Nomor WhatsApp">
            @error('whatsapp')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div><!-- col -->
        <div class="col-lg">
            <label>Username</label>
            <input class="form-control @error('username') is-invalid @enderror" type="text" name="username" value="{{ old('username') }}" placeholder="Username">
            @error('username')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div><!-- col -->
    </div><!-- row -->
    <div class="row row-sm mg-t-20">
        <div class="col-lg">
            <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
        </div><!-- col -->
    </div><!-- row -->
</form>
@endsection