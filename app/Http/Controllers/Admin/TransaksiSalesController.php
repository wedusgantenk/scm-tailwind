<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;

class TransaksiSalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Barang::all();
        return view('admin.transaksi.distribusi_sales.index', compact('data'));
    }

    public function create()
    {
        $jenis_barang = JenisBarang::all();
        return view('admin.transaksi.distribusi_sales.create', compact('jenis_barang'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|unique:barang',
                'jenis_barang_id' => 'required|numeric',
            ],
            [
                'nama.required' => 'Nama barang harus diisi',
                'nama.unique' => 'barang sudah ada',
                'jenis_barang_id.required' => 'Jenis barang harus dipilih',
                'jenis_barang_id.numeric' => 'Jenis barang harus dipilih',
            ]
        );
        Barang::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'id_jenis' => $request->jenis_barang_id,            
        ]);
        return redirect()->route('admin.transaksi.distribusi_sales')->with('success', 'barang telah ditambahkan');
    }

    public function edit($id)
    {
        $data = Barang::findorfail($id);
        $jenis_barang = JenisBarang::all();
        return view('admin.transaksi.distribusi_sales.edit', compact('data', 'jenis_barang'));
    }

    public function update(Request $request, $id)
    {
        $data = Barang::find($id);
        $request->validate(
            [
                'nama' => 'required',
                'jenis_barang_id' => 'required|numeric',
            ],
            [
                'nama.required' => 'Nama barang harus diisi',
                'jenis_barang_id.required' => 'Jenis barang harus dipilih',
                'jenis_barang_id.numeric' => 'Jenis barang harus dipilih',
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
            'id_jenis' => $request->jenis_barang_id,
        ]);

        return redirect()->route('admin.transaksi.distribusi_sales')->with('success', 'barang telah diubah');
    }

    public function destroy($id)
    {
        Barang::find($id)->delete();
        return redirect()->route('admin.transaksi.distribusi_sales')->with('success', 'barang telah dihapus');
    }
}
