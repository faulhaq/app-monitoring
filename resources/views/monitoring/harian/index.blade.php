@extends('template.home')
@section('heading', 'Monitoring Harian')
@section('page')
  <li class="breadcrumb-item active">Data Monitoring</li>
  <li class="breadcrumb-item active">Monitoring Harian</li>
@endsection
@section('content')
    <div class="col-lg-4 col-6">
        <a href="{{ route('monitoring.harian.index2') }}">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Monitoring Harian</h3>
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
