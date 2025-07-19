@extends('layout.main')
@section('content')
        <div class="az-content-label mg-b-5">Data Pengguna</div>
                <p class="mg-b-20"></p>
                    <a href="{{ route('admin-add') }}" class="btn btn-primary mb-3" style="border-radius: 5px;">
                        <i class="typcn typcn-plus"></i> Tambah Pengguna
                    </a>
                    <div class="table-responsive">
                    <table class="table table-bordered mg-b-0 display" id="example">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach ($data as $user)
                                <td width ='16am'>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td class="text-center">
                                    @if ($user->role == 'admin')
                                        <span class="badge badge-primary">Admin</span>
                                    @elseif ($user->role == 'tender')
                                        <span class="badge badge-info">Tender</span>
                                    @elseif ($user->role == 'pengawas')
                                        <span class="badge badge-warning">Pengawas</span>
                                    @else
                                        <span class="badge badge-secondary">User</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($user->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-icon-list d-flex flex-wrap justify-content-center">
                                        <a href="{{ route('admin-view', $user->id) }}" class="btn btn-indigo btn-icon m-1"  style="border-radius: 5px;"
style="border-radius: 10px;">
                                            <i class="typcn typcn-eye"></i>
                                        </a>
                                        <a href="{{ route('admin-edit', $user->id) }}" class="btn btn-warning btn-icon m-1"  style="border-radius: 5px;"
style="border-radius: 10px;">
                                            <i class="typcn typcn-edit"></i>
                                        </a>
                                        <button class="btn btn-danger btn-icon m-1"  style="border-radius: 5px;"
style="border-radius: 10px;">
                                            <i class="typcn typcn-trash"></i>
                                        </button>
                                    </div>
                                </td>
                                
                            </tr>

                            @endforeach
                        </tr>
                        </tbody>
                    </table>
            </div>
        </div><!-- az-content-body -->

@endsection