@extends('layout.main')
@section('content')
    <div class="az-content-label mg-b-5">Cek Dokumen Proyek</div>
    <p class="mg-b-20">Berikut adalah daftar dokumen proyek yang telah Anda pilih.</p>
    @if($monitoring->status_monitoring === 'non-approval')
    <a href="{{ route('add-dokument-pengawas', $monitoring->id) }}" class="btn btn-primary mb-4" style="border-radius: 5px"><i class="typcn typcn-folder-add mr-2"></i>Tambah Dokument</a>                    
    @endif
    <div class="card">
        <div class="card-header">
            <div class="row mt-3 mb-3">
                <div class="col-md-6">
                    <h5 class="card-title"></h5>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="mb-1"><strong>Lokasi: {{ $monitoring->nama_monitoring }}</strong></p>
                    <p class="mb-1"><strong>Anggaran:</strong></p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="mb-1"><strong>Status:</strong> </p>
                    <p class="mb-1"><strong>Deskripsi:</strong> </p>
                </div>
            </div> 
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto/Gambar</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokumentsss as $monitorings)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#imageModal{{ $monitorings->id }}">
                                            Lihat Gambar
                                        </button>  
                                        <!-- Modal -->
                                                <div class="modal fade" id="imageModal{{ $monitorings->id }}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{ $monitorings->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="imageModalLabel{{ $monitorings->id }}">Foto Monitoring</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/' . $monitorings->file_path_dokument) }}" alt="Foto Monitoring" class="img-fluid">
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                    </td>
                                    <td>{{ $monitorings->deskripsi_dokument }}</td>
                                    <td>
                                        @if($monitorings->status_dokument === 'pending')
                                            <span class="badge badge-warning">Menunggu Persetujuan</span>
                                        @elseif($monitorings->status_dokument === 'approved')
                                            <span class="badge badge-success">Disetujui</span>
                                        @elseif($monitorings->status_dokument === 'rejected')
                                            <span class="badge badge-danger">Ditolak</span>
                                        @elseif($monitorings->status_dokument === 'new')
                                            <span class="badge badge-primary">Baru</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($monitorings->status_dokument === 'pending')
                                            <div class="btn-icon-list d-flex flex-wrap justify-content-center">  <div class="btn-icon-list d-flex flex-wrap justify-content-center">
                                            <span>Menunggu Persetujuan Dinass</span>
                                            </div>
                                        @elseif($monitorings->status_dokument === 'new')
                                            <div class="btn-icon-list d-flex flex-wrap justify-content-center">  <div class="btn-icon-list d-flex flex-wrap justify-content-center">
                                            <a href="{{ route('edit-dokument-pengawas', $monitorings->id) }}" class="btn btn-warning btn-icon m-1" style="border-radius: 5px;">
                                                <i class="typcn typcn-edit"></i>
                                            </a>
                                            <form action="{{ route('delete-dokument-pengawas', $monitorings->id) }}" method="POST" class="form-hapus-dokument" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-icon m-1" style="border-radius: 5px;">
                                                    <i class="typcn typcn-trash"></i>
                                                </button>
                                        @else
                                            @if($monitorings->catatan != null)
                                                <span class="badge badge-warning">{{ $monitorings->catatan }}</span>
                                            @else
                                                <span class="badge badge-info">Tidak Ada Catatan</span>
                                            @endif
                                        @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($monitorings->catatan != null)
                                            <div class="btn-icon-list d-flex flex-wrap justify-content-center">
                                                <a href="#" class="btn btn-info btn-icon m-1" style="border-radius: 5px;" data-toggle="modal" data-target="#editAllModal{{ $monitorings->id }}">
                                                    <i class="typcn typcn-th-menu"></i>
                                                </a>
                                                <!-- Modal Edit Semua -->
                                                <div class="modal fade" id="editAllModal{{ $monitorings->id }}" tabindex="-1" role="dialog" aria-labelledby="editAllModalLabel{{ $monitorings->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editAllModalLabel{{ $monitorings->id }}">Ubah Dokumen</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('edit-dokument-pengawas-rev', $monitorings->id) }}" method="Post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="catatan">Catatan</label>
                                                                        <textarea class="form-control" id="catatan" name="catatan" disabled rows="3">{{ $monitorings->catatan }}</textarea>

                                                                        <label for="deskripsi_dokument" class="mt-3">Deskripsi</label>
                                                                        <textarea class="form-control" id="deskripsi_dokument" name="deskripsi_dokument" rows="3">{{ $monitorings->deskripsi_dokument }}</textarea>

                                                                        <input type="hidden" name="status_dokument" value="pending">

                                                                        <label for="file_path_dokument" class="mt-3">Foto/Gambar</label>
                                                                        <input type="file" class="form-control" id="file_path_dokument" name="file_path_dokument">
                                                                        @if($monitorings->file_path_dokument)
                                                                            <div class="mt-2">
                                                                                <img src="{{ asset('storage/' . $monitorings->file_path_dokument) }}" alt="Foto Monitoring" class="img-fluid" style="max-width: 200px;">
                                                                            </div>
                                                                        @endif

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  
    </div>
@endsection