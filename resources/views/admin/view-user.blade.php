@extends('layout.main')
@section('content')
    <div class="az-content-label mg-b-5">Detail Pengguna</div>
    <p class="mg-b-20">Berikut adalah detail pengguna yang dipilih.</p>
            <div class="row row-sm">
                <div class="col-lg">
                    <label>Nama</label>
                    <input class="form-control" type="text" value="{{ $user->name }}" readonly>
                </div><!-- col -->
                <div class="col-lg">
                    <label>Email</label>
                    <input class="form-control" type="text" value="{{ $user->email }}" readonly>
                </div><!-- col -->
            </div><!-- row -->
            <div class="row row-sm mg-t-20">
                <div class="col-lg">
                    <label>Role</label>
                    <input class="form-control" type="text" value="{{ $user->role }}" readonly>
                </div><!-- col -->
                <div class="col-lg">
                    <label>Status</label>
                    <input class="form-control" type="text" value="{{ $user->status }}" readonly>
                </div><!-- col -->
            </div><!-- row -->
            <div class="row row-sm mg-t-20">
                <div class="col-lg">
                    <label>Created At</label>
                    <input class="form-control" type="text" value="{{ $user->created_at->format('d-m-Y H:i') }}" readonly>
                </div><!-- col -->
                <div class="col-lg">
                    <label>Updated At</label>
                    <input class="form-control" type="text" value="{{ $user->updated_at->format('d-m-Y H:i') }}" readonly>
                </div><!-- col -->
            </div><!-- row -->
            <div class="row row-sm mg-t-20">
            <div class="col-lg">
                <label>File PDF</label>
                @if($user->file_path)
                    {{-- <a href="{{ asset('storage/' . $user->file_path) }}" class="btn btn-primary" target="_blank">
                        <i class="typcn typcn-document-text"></i> Lihat File PDF
                    </a> --}}
                        <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#pdfModal">
                            Lihat PDF
                        </button>
                        @if($user->status !== 'active')
                            <form action="{{ route('admin-users-activate', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Aktifkan User</button>
                            </form>
                        @else
                        <form action="{{ route('admin-users-activate', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Non Aktifkan User</button>
                            </form>
                        @endif

                        <!-- Modal -->
                        <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pdfModalLabel">File PDF</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <iframe src="{{ asset('storage/' . $user->file_path) }}" width="100%" height="500px" style="border:1px solid #ccc;"></iframe>
                            </div>
                            </div>
                        </div>
                        </div>
                @else
                    <p class="text-danger">File tidak tersedia.</p>
                    @if($user->status !== 'active')
                            <form action="{{ route('admin-users-activate', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Aktifkan User</button>
                            </form>
                    @endif
                @endif
            </div>
            
    </div>
@endsection 
