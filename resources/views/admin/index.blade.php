@extends('layout.main')
@section('content')
<div class="az-dashboard-one-title">
    <div>
        <h2 class="az-dashboard-title">Hi, welcome back !</h2>
        <p class="az-dashboard-text">Your web analytics dashboard template.</p>
    </div>
    <div class="az-content-header-right">
        <div class="media">
            <div class="media-body">
                <label>Time</label>
                <h6>{{ now()->format('H:i') }}</h6>
            </div><!-- media-body -->
        </div><!-- media -->
        <div class="media">
            <div class="media-body">
                <label>Date</label>
                <h6>{{ now()->format('d-m-Y') }}</h6>
            </div><!-- media-body -->
        </div><!-- media -->
        <div class="media">
            <div class="media-body">
                <label>Time Zone</label>
                <h6>{{ now()->timezone(config('app.timezone'))->getTimezone()->getName() }}</h6>
            </div><!-- media-body -->
        </div><!-- media -->
    </div>
</div><!-- az-dashboard-one-title -->
<div class="az-content-body">
    <div class="row row-sm">
        <!-- Card 1 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-primary fs-1 btn-icon">
                        <i class="typcn typcn-chart-bar-outline"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">Total Proyek</h6>
                        <h4 class="mb-0 fw-bold">{{ $totalProyek }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-success fs-1 btn-icon">
                        <i class="typcn typcn-user"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">Total Pengguna</h6>
                        <h4 class="mb-0 fw-bold">{{ $totalUsers }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-warning fs-1 btn-icon">
                        <i class="typcn typcn-chart-bar-outline"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">Total Tender</h6>
                        <h4 class="mb-0 fw-bold">{{ $totalTender }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-info fs-1 btn-icon">
                        <i class="typcn typcn-user-add"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">Pengguna Aktif</h6>
                        <h4 class="mb-0 fw-bold">{{ $activeUsers }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection