<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;

class LaporanAnggaranController extends Controller
{
    public function generateReport(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));

        // Mengambil data anggaran berdasarkan tahun
        $anggaran = Anggaran::whereYear('tanggal_kegiatan', $tahun)
            ->where('tanggal_kegiatan', '<', now())
            ->get();

        // Menghitung total biaya
        $totalBiaya = $anggaran->sum('biaya');

        // Mengelompokkan anggaran berdasarkan program
        $anggaranPerProgram = $anggaran->groupBy('program')->map(function ($program) {
            return [
                'total_biaya' => $program->sum('biaya'),
                'jumlah_kegiatan' => $program->count(),
            ];
        });

        return view('laporan.index', [
            'title' => 'laporan',
            'tahun' => $tahun,
            'totalBiaya' => $totalBiaya,
            'anggaranPerProgram' => $anggaranPerProgram,
            'anggaran' => $anggaran,
        ]);
    }
}
