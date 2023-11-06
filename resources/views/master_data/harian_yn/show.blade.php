@extends('template.home')
@section('heading', 'Details Guru')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('guru.index') }}">Guru</a></li>
  <li class="breadcrumb-item active">Details Guru</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row no-gutters ml-2 mb-2 mr-2">
                <div class="col-md-4">
                    @if ($guru->foto)
                        <img src="{{ asset('uploads/guru/'.$guru->foto) }}" class="card-img img-details" alt="{{ $guru->nama }}">
                    @else
                        <h3>Tidak ada foto</h3>
                    @endif
                </div>
                <div class="col-md-1 mb-4"></div>
                <div class="col-md-7">
                    <h5 class="card-title card-text mb-2">NIK : {{ $guru->nik }}</h5>
                    <h5 class="card-title card-text mb-2">NIP : {{ $guru->nip }}</h5>
                    <h5 class="card-title card-text mb-2">Nama : {{ $guru->nama }}</h5>
                    <h5 class="card-title card-text mb-2">Email : {{ $guru->email }}</h5>
                    <h5 class="card-title card-text mb-2">Jenis Kelamin : {{ $guru->jk === "L" ? "Laki-laki" : "Perempuan" }}</h5>
                    <h5 class="card-title card-text mb-2">Agama : {{ $guru->agama() }}</h5>
                    <h5 class="card-title card-text mb-2">Goldar : {{ $guru->goldar() }}</h5>
                    <h5 class="card-title card-text mb-2">Pekerjaan : {{ $guru->pekerjaan() }}</h5>
                    <h5 class="card-title card-text mb-2">Pendidikan : {{ $guru->pendidikan() }}</h5>
                    <h5 class="card-title card-text mb-2">No. Telepon : {{ $guru->telp }}</h5>
                    <h5 class="card-title card-text mb-2">Tempat Lahir : {{ $guru->tmp_lahir }}</h5>
                    <h5 class="card-title card-text mb-2">Tanggal Lahir : {{ fix_id_d($guru->tgl_lahir) }}</h5>
                    <h5 class="card-title card-text mb-2">Alamat : {{ $guru->alamat }}</h5>
                    <h5 class="card-title card-text mb-2">Status : {{ $guru->status === "aktif" ? "Aktif" : "Non-aktif" }}</h5> 
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('guru.index') }}" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
            <?php $enc_id = Crypt::encrypt($guru->id); ?>
            <a href="{{ route('guru.edit', $enc_id) }}" class="btn btn-success"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>    
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataGuru").addClass("active");
    </script>
@endsection
