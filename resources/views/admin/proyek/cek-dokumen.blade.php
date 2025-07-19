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
                                        <div class="btn-icon-list d-flex flex-wrap justify-content-center">  <div class="btn-icon-list d-flex flex-wrap justify-content-center">
                                            <a href="" class="btn btn-success btn-icon m-1">
                                                <i class="typcn typcn-tick "></i>
                                            </a>
                                            <a href="" class="btn btn-danger btn-icon m-1">
                                                <i class="typcn typcn-times"></i>
                                            </a>
                                        </div>
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