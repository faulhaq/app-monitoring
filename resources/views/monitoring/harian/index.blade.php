@extends('template.home')
@section('heading', 'Dashboard ' . Auth::user()->role())
@section('page')
    <li class="breadcrumb-item active">Data Monitoring</li>
    <li class="breadcrumb-item active">Monitoring Harian</li>
@endsection
@section('content')
    <div class="col-xl-4 ol-md-5 col-sm-6">
        <a href="{{ route('monitoring.harian.index2') }}">
            <div class="small-box pb-3 bg-info">
                <div class="inner">
                    <span class="menu-title">Monitoring Harian</span>
                    <p>Kegiatan Harian</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book nav-icon"></i>
                </div>
            </div>
        </a>
    </div>
@endsection
@section('script')
    <script>
        $("#Monitoring").addClass("active");
        $("#liMonitoring").addClass("menu-open");
        $("#DataMonitoringHarian").addClass("active");
    </script>
@endsection
