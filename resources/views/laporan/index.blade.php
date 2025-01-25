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

<div class="container">
    <h1>Laporan Anggaran Tahun {{ $tahun }}</h1>
    <p>Total Biaya: Rp {{ number_format($totalBiaya, 0, ',', '.') }}</p>

    <h2>Rincian Per Program</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Program</th>
                <th>Total Biaya</th>
                <th>Jumlah Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggaranPerProgram as $program => $data)
            <tr>
                <td>{{ $program }}</td>
                <td>Rp {{ number_format($data['total_biaya'], 0, ',', '.') }}</td>
                <td>{{ $data['jumlah_kegiatan'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Rincian Kegiatan</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Program</th>
                <th>Kegiatan</th>
                <th>Biaya</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggaran as $item)
            <tr>
                <td>{{ $item->tanggal_kegiatan }}</td>
                <td>{{ $item->program }}</td>
                <td>{{ $item->kegiatan }}</td>
                <td>Rp {{ number_format($item->biaya, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
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



