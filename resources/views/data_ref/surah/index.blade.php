@extends('template.home')
@section('heading', 'Data Ref Surah')
@section('page')
  <li class="breadcrumb-item active">Data Ref Surah</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body" style="overflow-x: scroll">
          <table class="table table-bordered table-hover" style="width: 100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Surah</th>
                    <th>Jumlah Ayat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($surah as $v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->nama }}</td>
                    <td>{{ $v->jumlah_ayat }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
@endsection
@section('script')
    <script>
        $("#DataRef").addClass("active");
        $("#liDataRef").addClass("menu-open");
        $("#DataRefSurah").addClass("active");
    </script>
@endsection
