<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
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

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "user_id" => "required",
            "program" => "required",
            "kegiatan" => "required",
            "biaya" => "required",
            "tanggal_kegiatan" => "required",
            "foto" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048", // Validasi file foto
            "keterangan" => "nullable|string",
        ]);

        $data = $request->all();

        // Proses unggah foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('uploads/foto', 'public');
        }

        Anggaran::create($data);

        return redirect()->route('anggaran.index')->with('success', 'Data Anggaran Berhasil Ditambahkan');
    }

    public function create()
    {
        return view('anggaran.create')->with([
            "title" => "Tambah Data Anggaran",
        ]);
    }

    public function edit(string $id)
    {
        $anggaran = Anggaran::findOrFail($id);

        return view('anggaran.edit')->with([
            "title" => "Edit Data Anggaran",
            "anggaran" => $anggaran,
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $anggaran = Anggaran::findOrFail($id);

        $request->validate([
            "user_id" => "required",
            "program" => "required",
            "kegiatan" => "required",
            "biaya" => "required",
            "tanggal_kegiatan" => "required",
            "foto" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048", // Validasi file foto
            "keterangan" => "nullable|string",
        ]);

        $data = $request->all();

        // Proses unggah foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('uploads/foto', 'public');
        }

        $anggaran->update($data);

        return redirect()->route('anggaran.index')->with('success', 'Data Anggaran Berhasil Diperbarui');
    }

    public function destroy(string $id): RedirectResponse
    {
        $anggaran = Anggaran::findOrFail($id);

        // Hapus file foto jika ada
        if ($anggaran->foto && \Storage::disk('public')->exists($anggaran->foto)) {
            \Storage::disk('public')->delete($anggaran->foto);
        }

        $anggaran->delete();

        return redirect()->route('anggaran.index')->with('success', 'Data Anggaran Berhasil Dihapus');
    }
}
