@extends('template.home')
@section('heading', 'Dashboard ' . Auth::user()->role())
@section('page')
    <li class="breadcrumb-item active">Data Monitoring</li>
    <li class="breadcrumb-item active">Monitoring Keagamaan</li>
@endsection
@section('content')

    @foreach ($menu as $item => $variant)
        <div class="col-xl-4 ol-md-5 col-sm-6">
            <a href="{{ route('monitoring.keagamaan.' . strtolower($item)) }}">
                <div class="small-box pb-3 {{ $variant }}">
                    <div class="inner" style="color: #FFFFFF;">
                        <span class="menu-title"> Monitoring {{ $item }} </span>
                        <p>{{ $item }}</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-clipboard"></i>
                    </div>
                </div>
            </a>
        </div>
    @endforeach

@endsection
@section('script')
    <script>
        $("#Monitoring").addClass("active");
        $("#liMonitoring").addClass("menu-open");
        $("#DataMonitoringKeagamaan").addClass("active");
    </script>
@endsection
