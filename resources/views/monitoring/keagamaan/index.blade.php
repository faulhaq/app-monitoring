@extends('template.home')
@section('heading', 'Dashboard')
@section('page')
  <li class="breadcrumb-item active">Admin</li>
  <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
    <!-- <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3> Monitoring Kegiatan </h3>
                <p>Kegiatan</p>
            </div>
            <div class="icon">
                <i class="fas fa-book nav-icon"></i>
            </div>
        </div>
    </div> -->
    <div class="col-lg-4 col-6">
        <a href="{{ route('monitoring.keagamaan.tahsin') }}">
        <div class="small-box bg-warning">
            <div class="inner" style="color: #FFFFFF;">
                <h3> Monitoring Tahsin </h3>
                <p>Tahsin</p>
            </div>
            <div class="icon">
                <i class="fas fa-book nav-icon"></i>
            </div>
        </div>
        </a>
    </div>
    <div class="col-lg-4 col-6">
        <a href="{{ route('monitoring.keagamaan.tahfidz') }}">
        <div class="small-box bg-success">
            <div class="inner">
                <h3> Monitoring Tahfidz </h3>
                <p>Tahfidz</p>
            </div>
            <div class="icon">
                <i class="fas fa-book nav-icon"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <a href="{{ route('monitoring.keagamaan.mahfudhot') }}">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3> Monitoring Mahfudhot </h3>
                <p>Mahfudhot</p>
            </div>
            <div class="icon">
                <i class="fas fa-book nav-icon"></i>
            </div>
        </div>        
    </div>

    <div class="col-lg-4 col-6">
        <a href="{{ route('monitoring.keagamaan.hadits') }}">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3> Monitoring Hadits </h3>
                <p>Hadits</p>
            </div>
            <div class="icon">
                <i class="fas fa-book nav-icon"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <a href="{{ route('monitoring.keagamaan.doa') }}">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3> Monitoring Doa </h3>
                <p>Doa</p>
            </div>
            <div class="icon">
                <i class="fas fa-book nav-icon"></i>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $("#Monitoring").addClass("active");
        $("#liMonitoring").addClass("menu-open");
        $("#DataMonitoringSekolah").addClass("active");
    </script>
@endsection