@extends('template.home')
@section('heading', 'Dashboard '.Auth::user()->role())
@section('page')
  <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
<div class="col-md-12">
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
                if ($isi === "") {
                $isi = "<h3>Tidak ada pengumuman!</h3>";
                }
                ?>
                {!! $isi !!}
            </div>
        </div>
    </div>
</div>  
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

@endsection
@section('script')
    <script>
      $("#Dashboard").addClass("active");
      $("#liDashboard").addClass("menu-open");
      $("#Home").addClass("active");

      $(document).ready(function () {
            'use strict'

            var pieChartCanvasGuru = $('#pieChartGuru').get(0).getContext('2d')
            var pieDataGuru        = {
                labels: [
                    'Laki-laki', 
                    'Perempuan',
                ],
                datasets: [
                    {
                    data: [{{ $guru_lk }}, {{ $guru_pr }}],
                    backgroundColor : ['#007BFF', '#DC3545'],
                    }
                ]
            }
            var pieOptions     = {
                legend: {
                    display: false
                }
            }
            var pieChart = new Chart(pieChartCanvasGuru, {
                type: 'doughnut',
                data: pieDataGuru,
                options: pieOptions      
            })


            var pieChartCanvasSiswa = $('#pieChartSiswa').get(0).getContext('2d')
            var pieDataSiswa        = {
                labels: [
                    'Laki-laki', 
                    'Perempuan',
                ],
                datasets: [
                    {
                    data: [{{ $siswa_lk }}, {{ $siswa_pr }}],
                    backgroundColor : ['#007BFF', '#DC3545'],
                    }
                ]
            }
            var pieOptions     = {
                legend: {
                    display: false
                }
            }
            var pieChart = new Chart(pieChartCanvasSiswa, {
                type: 'doughnut',
                data: pieDataSiswa,
                options: pieOptions      
            })
      });
    </script>
@endsection
