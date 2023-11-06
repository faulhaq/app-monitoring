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

    <ul class="nav nav-treeview ml-4">
        <li class="nav-item">
            <a href="{{ route('data_ref.surah.index') }}" class="nav-link" id="DataRefSurah">
                <i class="fas fa-users nav-icon"></i>
                <p>Data Surah</p>
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
        <!-- <li class="nav-item">
            <a href="{{ route('kk.index') }}" class="nav-link" id="DataKartuKeluarga">
                <i class="fas fa-users nav-icon"></i>
                <p>Data Keluarga</p>
            </a>
        </li> -->
        <li class="nav-item">
            <a href="{{ route('orang_tua.index') }}" class="nav-link" id="DataOrangTua">
                <i class="fas fa-users nav-icon"></i>
                <p>Data Orang Tua</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('siswa.index') }}" class="nav-link" id="DataSiswa">
                <i class="fas fa-users nav-icon"></i>
                <p>Data Siswa</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('guru.index') }}" class="nav-link" id="DataGuru">
                <i class="fas fa-users nav-icon"></i>
                <p>Data Guru</p>
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
            <a href="{{ route('harian_isian.index') }}" class="nav-link" id="DataHarianIsian">
                <i class="nav-icon fas fa-clipboard"></i>
                <p>Data Harian Isian</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('harian_yn.index') }}" class="nav-link" id="DataHarianYn">
                <i class="nav-icon fas fa-clipboard"></i>
                <p>Data Harian Yn</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link" id="DataUser">
                <i class="fas fa-user-plus nav-icon"></i>
                <p>Data User</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item has-treeview" id="liMonitoring">
    <a href="#" class="nav-link" id="Monitoring">
        <i class="nav-icon fas fa-edit"></i>
        <p>
            Data Monitoring
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview ml-4">
        <li class="nav-item">
            <a href="{{ route('monitoring.keagamaan.index') }}" class="nav-link" id="DataMonitoringKeagamaan">
                <i class="nav-icon fas fa-clipboard"></i>
                <p style="font-size:15px;">Monitoring Keagamaan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('monitoring.harian.index') }}" class="nav-link" id="DataMonitoringHarian">
                <i class="nav-icon fas fa-clipboard"></i>
                <p>Monitoring Harian</p>
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
