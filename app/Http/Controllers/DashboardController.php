<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggaran;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "dashboard";
        $totalAdmin = User::count();
        $totalAnggaran = Anggaran::sum('biaya');
        $terpakai = Anggaran::where('tanggal_kegiatan', '<=', now())->sum('biaya');
        $sisaAnggaran = $totalAnggaran - $terpakai;
        $totalProgram = Anggaran::distinct('program')->count();
        $kegiatanTerbaru = Anggaran::orderBy('tanggal_kegiatan', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'totalAnggaran',
            'terpakai',
            'sisaAnggaran',
            'totalProgram',
            'kegiatanTerbaru',
            'title',
            'totalAdmin'
        ));
    }

}
