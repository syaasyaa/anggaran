<?php

namespace App\Http\Controllers;

use App\models\Anggaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class AnggaranController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));
        $anggaran = Anggaran::whereYear('tanggal_kegiatan', $tahun)
            ->where('tanggal_kegiatan', '<', now())
            ->get();

        return view('anggaran.index', [
            "title" => "Data Anggaran",
            "anggaran" => $anggaran,
            "tahun" => $tahun
        ]);
    }

    public function store(Request $request):RedirectResponse{
        $request->validate([
            "user_id"=>"required",
            "program"=>"required",
            "kegiatan"=>'required',
            "biaya"=>'required',
            "tanggal_kegiatan"=>'required',
        ]);

        Anggaran::create($request->all());

        return redirect()->route('anggaran.index')->with('success','Data Anggaran Berhasil Ditambahkan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('anggaran.create')->with([
            "title" => "Ubah Data anggaran",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
