<?php

namespace App\Http\Controllers;

use App\Biodata;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function index()
    {
        $data['data_pendidikan'] = ['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3'];
        $data['data_gender'] = ['L' => 'Laki-laki', 'P' => 'Perempuan'];
        $data['data_hobi'] = ['Membaca', 'Olahraga', 'Ngoding', 'Nonton Film'];
        return view('crud', $data);
    }

    public function tampil()
    {
        $data = Biodata::all();
        return view('data', compact('data'));
    }

    public function tambah(Request $request)
    {
        $data = new Biodata();
        $data->nama = $request->nama;
        $data->username = $request->username;
        $data->alamat = $request->alamat;
        $data->telp = $request->telp;
        $data->pendidikan = $request->pendidikan;
        $data->gender = $request->gender;
        $data->hobi = json_encode($request->hobi);
        $data->save();
        return response()->json($data, 200);
    }

    public function ubah(Request $request)
    {
        $data = Biodata::find($request->id);
        $data->nama = $request->nama;
        $data->username = $request->username;
        $data->alamat = $request->alamat;
        $data->telp = $request->telp;
        $data->pendidikan = $request->pendidikan;
        $data->save();
        return response()->json($data, 200);
    }

    public function ambil(Request $request)
    {
        $data = Biodata::find($request->id);
        return response()->json($data, 200);
    }

    public function hapus(Request $request)
    {
        $data = Biodata::destroy($request->id);
        return response()->json($data, 200);
    }
}
