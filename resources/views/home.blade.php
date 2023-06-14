@extends('template_backend.home')
@section('heading', 'Dashboard')
@section('page')
  <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
    <div class="col-md-12" id="load_content">
      <div class="card card-primary">
    
      </div>
    </div>

    <div class="col-md-6">
      <div class="card card-warning" style="min-height: 385px;">
        <div class="card-header">
          <h3 class="card-title" style="color: white;">
            Pengumuman
          </h3>
        </div>
        <div class="card-body">
          <div class="tab-content p-0">
            {!! $pengumuman->isi !!}
          </div>
        </div>
      </div>
    </div>

    <?php $user = Auth::user(); ?>

    @if ($user->role === 'OrangTua')
      @include('orang_tua.index')
    @endif
  
@endsection
@section('script')
    <script>
      $("#Dashboard").addClass("active");
      $("#liDashboard").addClass("menu-open");
      $("#Home").addClass("active");
    </script>
@endsection
