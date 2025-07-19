@extends('layout.main')
@section('content')
    <div class="az-content-label mg-b-5">Edit Pengguna</div>
    <p class="mg-b-20">Silakan ubah detail pengguna di bawah ini.</p>
    
    <form action="{{ route('admin-update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row row-sm">
            <div class="col-lg">
                <label>Nama</label>
                <input class="form-control" type="text" name="name" value="{{ $user->name }}" required>
            </div><!-- col -->
            <div class="col-lg">
                <label>Email</label>
                <input class="form-control" type="email" name="email" value="{{ $user->email }}" required>
            </div><!-- col -->
        </div><!-- row -->
        
        <div class="row row-sm mg-t-20">
            <div class="col-lg">
                <label>Role</label>
                <select class="form-control" name="role" required>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="tender" {{ $user->role == 'tender' ? 'selected' : '' }}>Tender</option>
                    <option value="pengawas" {{ $user->role == 'pengawas' ? 'selected' : '' }}>Pengawas</option>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div><!-- col -->
            <div class="col-lg">
                <label>Status</label>
                <select class="form-control" name="status" required>
                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $user->status == 'non-active' ? 'selected' : '' }}>Non Active</option>
                </select>
            </div><!-- col -->
        </div><!-- row -->
        
        <div class="row row-sm mg-t-20">
            <div class="col-lg">
            <label>WhatsApp</label>
            <input class="form-control" type="text" name="whatsapp" value="{{ $user->whatsapp ?? '' }}" placeholder="Nomor WhatsApp">
            </div><!-- col -->
            <div class="col-lg">
            <label>Username</label>
            <input class="form-control" type="text" name="username" value="{{ $user->username ?? '' }}" placeholder="Username" required>
            </div><!-- col -->
        </div><!-- row -->
        <div class="row row-sm mg-t-20">
            <div class="col-lg">
                <button type="submit" class="btn btn-warning">Update Pengguna</button>
            </div><!-- col -->
        </div><!-- row -->
    </form>
</div><!-- az-content-body -->
@endsection