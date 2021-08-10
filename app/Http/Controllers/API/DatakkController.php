<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\Datakk;


class DatakkController extends Controller
{
    public function create(Request $request)
    {
        $penduduk = new Penduduk;
        $penduduk->nik = $request->nik;
        $penduduk->nama = $request->nama;
        $penduduk->alamat = $request->alamat;
        $penduduk->no_telp = $request->no_telp;
        $penduduk->save();

        foreach ($request->list_datakk as $key => $value)
        {
            $datakk = array(
                'penduduk_id'=> $penduduk->id,
                'nokk'=>$value['nokk'],
                'nama_kepala'=>$value['nama_kepala']
            );
            $datakks = Datakk::create($datakk);
        }

        return response()->json([
            'message'=>'Success',
        ],200);
    }

    public function getPenduduk($id)
    {
        $penduduk = Penduduk::with('datakk')->where('id',$id)->first();
        return response()->json([
            'message'=>'Success',
            'data_penduduk'=>$penduduk
        ],200);
    }

    public function update(Request $request, $id)
    {
        $penduduk = Penduduk::find($id);
        $penduduk->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp
        ]);

        Datakk::where('penduduk_id', $id)->delete();

        foreach ($request->list_datakk as $key => $value)
        {
            $datakk = array(
                'penduduk_id'=> $penduduk->id,
                'nokk'=>$value['nokk'],
                'nama_kepala'=>$value['nama_kepala']
            );
            $datakks = Datakk::create($datakk);
        }

        return response()->json([
            'message'=>'Success',
        ],200);

    }

    public function delete($id)
    {
        $datakk = Datakk::find($id)->delete();
        return response()->json([
            'message'=>'Data berhasil Kartu Keluarga dihapus',
        ],200);
    }
}
