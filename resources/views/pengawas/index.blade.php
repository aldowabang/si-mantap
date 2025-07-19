@extends('layout.main')
@section('content')
<div class="az-dashboard-one-title">
    <div>
        <h2 class="az-dashboard-title">Hi, welcome back {{ $title}}!</h2>
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
        <div class="media">
            <div class="media-body">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div><!-- az-dashboard-one-title -->
@endsection