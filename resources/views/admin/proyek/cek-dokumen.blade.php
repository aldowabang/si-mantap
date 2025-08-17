    @extends('layout.main')
    @section('content')
        <div class="az-content-label mg-b-5">Cek Dokumen Proyek</div>
        <p class="mg-b-20">Berikut adalah daftar dokumen proyek yang telah Anda pilih.</p>
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
                                    <th>Tanggal Diubah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dokumentsss as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#imageModal{{ $row->id }}">
                                                    Lihat Gambar
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="imageModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{ $row->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="imageModalLabel{{ $row->id }}">Foto Monitoring</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/' . $row->file_path_dokument) }}" alt="Foto Monitoring" class="img-fluid">
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                        </td>

                                        <td>{{ $row->deskripsi_dokument }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($row->status_dokument === 'approved')
                                                    badge-success
                                                @elseif($row->status_dokument === 'rejected')
                                                    badge-danger
                                                @else
                                                    badge-warning
                                                @endif">
                                                {{ $row->status_dokument }}
                                            </span>
                                        <td>
                                            {{ $row->updated_at->format('d-m-Y H:i') }}
                                        </td>
                                        <td>


                                        @if($row->status_dokument === 'pending')
                                        <div class="btn-icon-list d-flex flex-wrap justify-content-center">  <div class="btn-icon-list d-flex flex-wrap justify-content-center">
                                            <form action="{{ route('konfirmasi-dokument-admin', $row->id) }}" method="POST" class="form-konfirmasi-dokument m-1">
                                                @csrf
                                                <input type="hidden" name="document" value="{{ $row->id }}">
                                                <button type="submit" class="btn btn-success btn-icon m-1" style="border-radius: 5px">
                                                    <i class="typcn typcn-tick"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-danger btn-icon m-1" style="border-radius: 5px" data-toggle="modal" data-target="#rejectModal{{ $row->id }}">
                                                <i class="typcn typcn-bell"></i>
                                            </button>

                                            <div class="modal fade" id="rejectModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel{{ $row->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <form action="{{ route('rejected-dokument-admin', $row->id) }}" method="POST" class="form-konfirmasi-dokument">
                                                        @csrf
                                                        
                                                        <input type="hidden" name="monitoring_id" value="{{ $row->id }}">
                                                        <input type="hidden" name="wa" value="{{ $pengawas_proyekkk->whatsapp }}">
                                                        <input type="hidden" name="n" value="{{ $pengawas_proyekkk->name }}">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="rejectModalLabel{{ $row->id }}">Catatan Penolakan Dokumen</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mb-3">
                                                                    <div class="col-md-6">
                                                                        <strong>Deskripsi Dokumen:</strong>
                                                                        <p>{{ $row->deskripsi_dokument }}</p>
                                                                        <strong>Status Saat Ini:</strong>
                                                                        <p>
                                                                            <span class="badge 
                                                                                @if($row->status_dokument === 'approved')
                                                                                    badge-success
                                                                                @elseif($row->status_dokument === 'rejected')
                                                                                    badge-danger
                                                                                @else
                                                                                    badge-warning
                                                                                @endif">
                                                                                {{ $row->status_dokument }}
                                                                            </span>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-6 text-center">
                                                                        <strong>Foto/Gambar:</strong>
                                                                        <img src="{{ asset('storage/' . $row->file_path_dokument) }}" alt="Foto Monitoring" class="img-fluid rounded mb-2" style="max-height:200px;">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="catatan{{ $row->id }}">Catatan Penolakan</label>
                                                                    <textarea class="form-control" name="catatan" id="catatan{{ $row->id }}" rows="4" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 5px">Batal</button>
                                                                <button type="submit" class="btn btn-danger" style="border-radius: 5px">Tolak</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>  
                                            @else
                                            <!-- Tombol Tolak dengan Modal Catatan -->
                                            <button type="button" class="btn btn-danger btn-icon m-1" style="border-radius: 5px" data-toggle="modal" data-target="#rejectModal{{ $row->id }}">
                                                <i class="typcn typcn-bell"></i>
                                            </button>

                                            <!-- Modal Catatan Penolakan -->
                                            <div class="modal fade" id="rejectModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel{{ $row->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <form action="{{ route('rejected-dokument-admin', $row->id) }}" method="POST" class="form-konfirmasi-dokument">
                                                        @csrf
                                                        <input type="hidden" name="monitoring_id" value="{{ $row->id }}">
                                                            <input type="hidden" name="wa" value="{{ $pengawas_proyekkk->whatsapp }}">
                                                        <input type="hidden" name="n" value="{{ $pengawas_proyekkk->name }}">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="rejectModalLabel{{ $row->id }}">Catatan Penolakan Dokumen</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mb-3">
                                                                    <div class="col-md-6">
                                                                        <strong>Deskripsi Dokumen:</strong>
                                                                        <p>{{ $row->deskripsi_dokument }}</p>
                                                                        <strong>Status Saat Ini:</strong>
                                                                        <p>
                                                                            <span class="badge 
                                                                                @if($row->status_dokument === 'approved')
                                                                                    badge-success
                                                                                @elseif($row->status_dokument === 'rejected')
                                                                                    badge-danger
                                                                                @else
                                                                                    badge-warning
                                                                                @endif">
                                                                                {{ $row->status_dokument }}
                                                                            </span>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-6 text-center">
                                                                        <strong>Foto/Gambar:</strong>
                                                                        <img src="{{ asset('storage/' . $row->file_path_dokument) }}" alt="Foto Monitoring" class="img-fluid rounded mb-2" style="max-height:200px;">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="catatan{{ $row->id }}">Catatan Penolakan</label>
                                                                    <textarea class="form-control" name="catatan" id="catatan{{ $row->id }}" rows="4" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 5px">Batal</button>
                                                                <button type="submit" class="btn btn-danger" style="border-radius: 5px">Tolak</button>
                                                            </div>
                                                        </div>
                                                    </form>
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