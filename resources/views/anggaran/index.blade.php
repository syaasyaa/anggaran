@extends('layouts.template')
@section('tambahanCSS')
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Toastr -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
@endsection


@section('judulh1','Admin - Anggaran')


@section('konten')

<li class="nav-item">
<div class="card card-info">
        <div class="card-header">
            <h2 class="card-title">Data Customer</h2>
            <a type="button" class="btn btn-success float-right" href="{{ route('anggaran.create') }}">
                <i class=" fas fa-plus"></i> Tambah Product
            </a>
        </div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Laporan</h3>
        <form method="GET" action="{{ route('anggaran.index') }}" class="form-inline float-right">
            <div class="form-group">
                <label for="tahun" class="mr-2">Pilih Tahun:</label>
                <select name="tahun" id="tahun" class="form-control">
                    @foreach(range(date('Y'), date('Y') - 10) as $tahun)
                        <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                            {{ $tahun }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary ml-2">Cari</button>
        </form>
    </div>
        <!-- /.card-header -->

        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>No</th>
                        <th>admin</th>
                        <th>program</th>
                        <th>kegiatan</th>
                        <th>biaya</th>
                        <th>tanggal_kegiatan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($anggaran as $dt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dt->User->name }}</td>
                        <td>{{ $dt->program }}</td>
                        <td>{{ $dt->kegiatan }}</td>
                        <td>{{ $dt->biaya }}</td>
                        <td>{{ $dt->tanggal_kegiatan }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection


@section('tambahanJS')
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


@endsection


@section('tambahScript')
    <script>
        $(document).ready(function() {
            $("#example2").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "responsive": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

            @if ($message = Session::get('success'))
                toastr.success("{{ $message }}");
            @elseif ($message = Session::get('updated'))
                toastr.warning("{{ $message }}");
            @elseif ($message = Session::get('deleted'))
                toastr.error("{{ $message }}");
            @endif
        });
    </script>
@endsection



