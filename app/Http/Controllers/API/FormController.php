<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nik'=>'required',
            'nama'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required',
        ]);

        //proses isi data
        $penduduk = new Penduduk;
        $penduduk->nik = $request->nik;
        $penduduk->nama = $request->nama;
        $penduduk->alamat = $request->alamat;
        $penduduk->no_telp = $request->no_telp;
        $penduduk->save();

        return response()->json([
            'message'=>'Data berhasil disimpan',
            'data_penduduk'=> $penduduk
        ],200);
    }

    public function edit($id)
    {
        $penduduk = Penduduk::find($id);
        return response()->json([
            'message'=>'Berhasil masuk ke halaman edit',
            'data_penduduk'=> $penduduk
        ],200);
    }

    public function update(Request $request, $id)
    {
        $penduduk = Penduduk::find($id);

        $request->validate([
            'nik'=>'required',
            'nama'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required',
        ]);

        $penduduk->update([
            'nik'=>$request->nik,
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'no_telp'=>$request->no_telp,
        ]);

        return response()->json([
            'message'=>'Success',
            'data_penduduk'=> $penduduk
        ],200);
    }

    public function delete($id)
    {
        $penduduk = Penduduk::find($id)->delete();
        return response()->json([
            'message'=>'Data berhasil penduduk dihapus',
        ],200);
    }
}
