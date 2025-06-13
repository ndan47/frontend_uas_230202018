<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;

class MahasiswaController extends Controller
{
    public function index()
    {
        $response = Http::get(config('services.api.api_url_base') . '/mahasiswa')->json();
        return view('mahasiswa.index',['mahasiswas' => $response]);
    }

    public function create()
    {
        return view('mahasiswa.create');
    }
    public function store(Request $request)
    {

        $this->validate($request, [

            'npm' => 'required',
            'nama_mahasiswa' => 'required',
            'id_kelas' => 'required',
            'kode_prodi' => 'required',
        ]);
        $response = Http::post(config('services.api.api_url_base') . '/mahasiswa', [
            'npm' => $request->npm,
            'nama_mahasiswa' => $request->nim,
            'id_kelas' => $request->id_kelas,
            'kode_prodi' => $request->kode_prodi,
        ]);
        return redirect()->route('mahasiswa.index');
    }
    public function edit($nim)
    {
        $response = Http::get(config('services.api.api_url_base') . '/mahasiswa/' . $nim);
        return view('mahasiswa.edit', ['mahasiswa' => $response->json()]);
    }
    public function update(Request $request, $nim)
    {
        $this->validate($request, [
            'npm' => 'required',
            'nama_mahasiswa' => 'required',
            'id_kelas' => 'required|email',
            'kode_prodi' => 'required',
        ]);

        $response = Http::put(config('services.api.api_url_base') . '/mahasiswa/' . $nim, [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'prodi' => $request->prodi,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate.');
    }
    public function destroy($nim)
    {
        $response = Http::delete(config('services.api.api_url_base') . '/mahasiswa/' . $nim);
        return redirect()->route('mahasiswa.index');
    }
}
