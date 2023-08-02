<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link" style="">
        <!-- <img src="{{ asset('img/favicon.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"> -->
        <span class="brand-text font-weight-light">MI NURROHMAH BINA INSANI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link" id="Dashboard">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview" id="liDataRef">
                        <a href="#" class="nav-link" id="DataRef">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Data Ref
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-4">
                            <li class="nav-item">
                                <a href="{{ route('data_ref.agama.index') }}" class="nav-link" id="DataRefAgama">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Data Agama</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav nav-treeview ml-4">
                            <li class="nav-item">
                                <a href="{{ route('data_ref.goldar.index') }}" class="nav-link" id="DataRefGoldar">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Data Golongan Darah</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav nav-treeview ml-4">
                            <li class="nav-item">
                                <a href="{{ route('data_ref.pekerjaan.index') }}" class="nav-link" id="DataRefPekerjaan">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Data Pekerjaan</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav nav-treeview ml-4">
                            <li class="nav-item">
                                <a href="{{ route('data_ref.pendidikan.index') }}" class="nav-link" id="DataRefPendidikan">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Data Pendidikan</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview" id="liMasterData">
                        <a href="#" class="nav-link" id="MasterData">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Data Master
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-4">
                           
                            <li class="nav-item">
                                <a href="{{ route('guru.index') }}" class="nav-link" id="DataGuru">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Data Guru</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('siswa.index') }}" class="nav-link" id="DataSiswa">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Data Siswa</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('orang_tua.index') }}" class="nav-link" id="DataOrangTua">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Data Orang Tua</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('kelas.index') }}" class="nav-link" id="DataKelas">
                                    <i class="fas fa-home nav-icon"></i>
                                    <p>Data Kelas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tahun_ajaran.index') }}" class="nav-link" id="DataTahunAjaran">
                                    <i class="fas fa-home nav-icon"></i>
                                    <p>Data Tahun Ajaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link" id="DataUser">
                                    <i class="fas fa-user-plus nav-icon"></i>
                                    <p>Data User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('monitoring_rumah.index') }}" class="nav-link" id="DataMonitoringRumah">
                                    <i class="nav-icon fas fa-clipboard"></i>
                                    <p>Monitoring Rumah</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('pengumuman.index') }}" class="nav-link" id="Pengumuman">
                            <i class="nav-icon fas fa-clipboard"></i>
                            <p>Pengumuman</p>
                        </a>
                    </li>
                @elseif (Auth::user()->role == 'Guru' && Auth::user()->guru(Auth::user()->id_card))
                    <li class="nav-item has-treeview">
                        <a href="{{ route('home') }}" class="nav-link" id="Home">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview" id="liNilaiGuru">
                        <a href="#" class="nav-link" id="NilaiGuru">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>
                                Nilai
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-4">
                           
                            <li class="nav-item">
                                <a href="{{ route('rapot.index') }}" class="nav-link" id="RapotGuru">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Entry Nilai Rapot</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('nilai.index') }}" class="nav-link" id="DesGuru">
                                    <i class="fas fa-file-alt nav-icon"></i>
                                    <p>Deskripsi Predikat</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @elseif (Auth::user()->role == 'Siswa' && Auth::user()->siswa(Auth::user()->no_induk))
                    <li class="nav-item has-treeview">
                        <a href="{{ url('/') }}" class="nav-link" id="Home">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                @else
                    <li class="nav-item has-treeview">
                        <a href="{{ url('/') }}" class="nav-link" id="Home">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>