<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailBarang;
use Illuminate\Http\Request;

class DetailBarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DetailBarang::all();
        return view('admin.detail_barang.index', compact('data'));
    }

    public function create()
    {
        $jenis_barang = DetailBarang::all();
        return view('admin.detail_barang.create', compact('jenis_barang'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|unique:barang',
                'id_jenis' => 'required|numeric',
                'fisik' => ['in:1,0']
            ],
            [
                'nama.required' => 'Nama barang harus diisi',
                'nama.unique' => 'barang sudah ada',
                'id_jenis.required' => 'Jenis barang harus dipilih',
                'id_jenis.numeric' => 'Jenis barang harus dipilih',
            ]
        );
        DetailBarang::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'id_jenis' => $request->id_jenis,            
            'fisik' => $request->has('fisik'),
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('admin.detail_barang')->with('success', 'barang telah ditambahkan');
    }

    public function edit($id)
    {
        $data = DetailBarang::findorfail($id);
        $jenis_barang = DetailBarang::all();
        return view('admin.detail_barang.edit', compact('data', 'jenis_barang'));
    }

    public function update(Request $request, $id)
    {
        $data = DetailBarang::find($id);
        $request->validate(
            [
                'nama' => 'required',
                'id_jenis' => 'required|numeric',
                'fisik' => ['in:1,0']
            ],
            [
                'nama.required' => 'Nama barang harus diisi',
                'id_jenis.required' => 'Jenis barang harus dipilih',
                'id_jenis.numeric' => 'Jenis barang harus dipilih',
            ]
        );
        if ($data->nama != $request->nama) {
            $request->validate(
                [
                    'nama' => 'unique:barang',
                ],
                [
                    'nama.unique' => 'nama barang sudah ada',
                ]
            );
        }
        $data->update([           
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'id_jenis' => $request->id_jenis,            
            'fisik' => $request->has('fisik'),
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.detail_barang')->with('success', 'barang telah diubah');
    }

    public function destroy($id)
    {
        DetailBarang::find($id)->delete();
        return redirect()->route('admin.detail_barang')->with('success', 'barang telah dihapus');
    }
}
