<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
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
        $data = DetailBarang::with('barang')->get();
        
        return view('admin.detail_barang.index', compact('data'));
    }

    public function create()
    {
        $data = DetailBarang::all();
        $nama_barang = Barang::all();
        return view('admin.detail_barang.create', compact('data', 'nama_barang'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'id_barang' => 'required|numeric',
                'kode_unik' => 'required|numeric',
                // 'status' => ['in:1,0']
            ],
            // [
            //     'nama.required' => 'Nama barang harus diisi',
            //     'nama.unique' => 'barang sudah ada',
            //     'id_jenis.required' => 'Jenis barang harus dipilih',
            //     'id_jenis.numeric' => 'Jenis barang harus dipilih',
            // ]
        );
        DetailBarang::create([
            'id_barang' => $request->id_barang,
            'kode_unik' => $request->kode_unik,
            // 'status' => $request->id_jenis,            
            // 'fisik' => $request->has('fisik'),
            // 'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('admin.detail_barang')->with('success', 'barang telah ditambahkan');
    }

    public function edit($id)
    {
        $data = DetailBarang::findorfail($id);
        $nama_barang = Barang::all();
        return view('admin.detail_barang.edit', compact('data', 'nama_barang'));
    }

    public function update(Request $request, $id)
    {
        $data = DetailBarang::find($id);
        $request->validate(
            [
                'id_barang' => 'required|numeric',
                'kode_unik' => 'required|numeric',
                // 'fisik' => ['in:1,0']
            ],
            // [
            //     'nama.required' => 'Nama barang harus diisi',
            //     'id_jenis.required' => 'Jenis barang harus dipilih',
            //     'id_jenis.numeric' => 'Jenis barang harus dipilih',
            // ]
        );

        $data = DetailBarang::findOrFail($id);
        
        $data->update([           
            'id_barang' => $request->id_barang,
            'kode_unik' => $request->kode_unik,
        ]);

        return redirect()->route('admin.detail_barang')->with('success', 'barang telah diubah');
    }

    public function destroy($id)
    {
        DetailBarang::find($id)->delete();
        return redirect()->route('admin.detail_barang')->with('success', 'detail barang telah dihapus');
    }
}
