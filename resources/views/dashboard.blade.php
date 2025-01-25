@extends('layouts.template')

@section('judulh1', 'Dashboard')

@section('konten')

<div class="row">
    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $terpakai }}</h3>
                <p>Total anggaran</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="{{ route('anggaran.index') }}" class="small-box-footer">
                Lihat Data <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalAdmin }}</h3>
                <p>Total Admin</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <a href="{{ route('pengguna.index') }}" class="small-box-footer">
                Lihat Pengguna <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Fitur 3: Peserta Pelatihan -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>Rp{{ number_format($totalAnggaran, 0, ',', '.') }}</h3>
                <p>Total biaya angaran</p>
            </div>
            <div class="icon">
<i class="fa-light fa-money-bill"></i>
            </div>
            <a href="{{ route('anggaran.index') }}" class="small-box-footer">
                Lihat anggaran <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Fitur 4: Laporan -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $totalProgram }}</h3>
                <p>Total anggaran</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-alt"></i>

            </div>
            <a href="#" class="small-box-footer">
                Lihat Laporan <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>


    <!-- 5 Data Pelatihan Terakhir -->

    <div class="card mt-4 w-100">
        <div class="card-header">
            <h3 class="card-title">5 Data anggaran Terakhir</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama program</th>
                            <th>nama kegiatan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kegiatanTerbaru as $anggaran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $anggaran->program }}</td>
                                <td>{{ $anggaran->kegiatan }}</td>
                                <td>{{ $anggaran->tanggal_kegiatan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
