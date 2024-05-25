@extends('template.home')
@section('heading', 'Dashboard ' . Auth::user()->role())
@section('page')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
    <div class="col-md-6">
        <div class="card card-secondary" style="min-height: 385px;">
            <div class="card-header">
                <h3 class="card-title" style="color: white;">
                    Profile</h3>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column align-items-center">
                    @if (is_null($profil))
                        <div class="mt-3">
                            <img src="{{ asset('img/placeholder.jpg') }}" class="profile-user-img img-fluid rounded-circle"
                                alt="Foto profil">
                        </div>
                        <div class="mt-3 text-center">
                            <div class="text-bold">Admin {{ Auth::user()->id }}</div>
                            <div class="text-muted">{{ Auth::user()->email }}</div>
                        </div>
                    @else
                        <div class="mt-3">
                            <img src="{{ $profil->foto }}" class="profile-user-img img-fluid rounded-circle"
                                alt="Foto profil">
                        </div>
                        <div class="mt-3 text-center">
                            <div class="text-bold">{{ $profil->nama }}</div>
                            <div class="text-muted">{{ $profil->email }}</div>
                            <div class="text-muted">{{ $profil->nik }}</div>
                        </div>
                    @endif
                </div>
            </div>
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
                    <?php
                    $isi = trim($pengumuman->isi);
                    if ($isi === '') {
                        $isi = '<h3>Tidak ada pengumuman!</h3>';
                    }
                    ?>
                    {!! $isi !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-info" style="min-height: 385px;">
            <div class="card-header">
                <h3 class="card-title" style="color: white;">
                    Pemberitahuan
                </h3>
            </div>
            <div class="card-body">
                @if (Auth::user()->role === 'guru')
                    <div class="alert alert-info" role="alert">
                        Notifikasi untuk guru
                    </div>
                @elseif(Auth::user()->role === 'orang_tua')
                    <div class="alert alert-info" role="alert">
                        Notifikasi untuk orang tua
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        Anda tidak memiliki akses untuk fitur ini
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-success" style="min-height: 385px;">
            <div class="card-header">
                <h3 class="card-title" style="color: white;">
                    Pencapaian
                </h3>
            </div>
            <div class="card-body">
                @if (Auth::user()->role === 'guru')
                    <div class="alert alert-info" role="alert">
                        Notifikasi untuk guru
                    </div>
                @elseif(Auth::user()->role === 'orang_tua')
                    <div class="alert alert-info" role="alert">
                        Notifikasi untuk orang tua
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        Anda tidak memiliki akses untuk fitur ini
                    </div>
                @endif
                </>
            </div>
        </div>
    </div>

    @if (Auth::user()->role !== 'orang_tua')
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">Data Guru</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
                                <h2> Total Guru {{ $guru_all }} </h2>
                            </span>
                        </p>
                    </div>
                    <div class="position-relative mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="chart-responsive">
                                    <canvas id="pieChartGuru" height="200"></canvas>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <ul class="chart-legend clearfix">
                                    <li><i class="far fa-circle text-primary"></i> Laki-laki</li>
                                    <li><i class="far fa-circle text-danger"></i> Perempuan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">Data Siswa</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
                                <h2> Total Siswa {{ $siswa_all }} </h2>
                            </span>
                        </p>
                    </div>
                    <div class="position-relative mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="chart-responsive">
                                    <canvas id="pieChartSiswa" height="200"></canvas>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <ul class="chart-legend clearfix">
                                    <li><i class="far fa-circle text-primary"></i> Laki-laki</li>
                                    <li><i class="far fa-circle text-danger"></i> Perempuan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var pieChartCanvasGuru = $('#pieChartGuru').get(0).getContext('2d');
            var pieDataGuru = {
                labels: [
                    'Laki-laki', 'Perempuan',
                ],
                datasets: [{
                    data: [{{ $guru_lk }}, {{ $guru_pr }}],
                    backgroundColor: ['#007BFF', '#DC3545'],
                }]
            };
            var pieOptionsGuru = {
                legend: {
                    display: false
                }
            };
            var pieChartGuru = new Chart(pieChartCanvasGuru, {
                type: 'doughnut',
                data: pieDataGuru,
                options: pieOptionsGuru
            });


            var pieChartCanvasSiswa = $('#pieChartSiswa').get(0).getContext('2d');
            var pieDataSiswa = {
                labels: [
                    'Laki-laki', 'Perempuan',
                ],
                datasets: [{
                    data: [{{ $siswa_lk }}, {{ $siswa_pr }}],
                    backgroundColor: ['#007BFF', '#DC3545'],
                }]
            };
            var pieOptionsSiswa = {
                legend: {
                    display: false
                }
            };
            var pieChartSiswa = new Chart(pieChartCanvasSiswa, {
                type: 'doughnut',
                data: pieDataSiswa,
                options: pieOptionsSiswa
            });
        });
    </script>
@endsection
