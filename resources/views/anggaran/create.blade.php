@extends('layouts.template')
@section('judulh1', 'Admin - Anggaran')


@section('konten')
<div class="col-md-6">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Anggaran</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('anggaran.store') }}" method="POST">
            @csrf
            <div class=" card-body">
                <div class="form-group">

                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ Auth::user()->id}}"
                        readonly>
                </div>
                <div class=" card-body">
                    <div class="form-group">
                        <label for="name">program</label>
                        <input type="text" class="form-control" id="program" name="program" required>
                    </div>
                    <div class="form-group">
                        <label for="email">kegiatan</label>
                        <input type="text" class="form-control" id="kegiatan" name="kegiatan" required>
                    </div>
                    <div class="form-group">
                        <label for="password">biaya</label>
                        <input type="text" class="form-control" id="biaya" name="biaya" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">tanggal_kegiatan</label>
                        <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control" id="foto">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
                    </div>

                </div>
                <!-- /.card-body -->


                <div class="card-footer">
                    <button type="submit" class="btn btn-success float-right">Simpan</button>
                </div>
        </form>
    </div>
</div>
@endsection