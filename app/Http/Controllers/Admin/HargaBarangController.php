<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\HargaBarang;
use App\Models\JenisOutlet;
use Illuminate\Http\Request;

class HargaBarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = HargaBarang::with('barang', 'jenisOutlet')->get();
        return view('admin.harga_barang.index', compact('data'));
        
    }

    public function create()
    {
        $barang = Barang::all();
        $jenis_outlet = JenisOutlet::all();
        return view('admin.harga_barang.create', compact('jenis_outlet','barang'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'id_barang' => 'required|numeric',
                'tanggal' => 'required',
                'id_jenis_outlet' => 'required|numeric',
                'harga' => 'required|numeric',
            ],
            [                
                'harga.required' => 'Harga harus dipilih',
                'harga.numeric' => 'Harga harus dipilih',
                'barang_id.required' => 'Barang harus dipilih',
                'barang_id.numeric' => 'Barang harus dipilih',
                'tanggal.required' => 'Tanggal harus dipilih',
                'jenis_outlet_id.required' => 'Jenis Outlet harus dipilih',
                'jenis_outlet_id.numeric' => 'Jenis Outlet harus dipilih',
            ]
        );
        HargaBarang::create([
            'id_barang' => $request->id_barang,
            'tanggal' => $request->tanggal,
            'id_jenis_outlet' => $request->id_jenis_outlet,  
            'harga' => $request->harga,          
        ]);
        return redirect()->route('admin.harga_barang')->with('success', 'Harga barang telah ditambahkan');
    }

    public function edit($id)
    {
        $data = HargaBarang::findorfail($id);
        $jenis_outlet = JenisOutlet::all();
        $barang = Barang::all();
        return view('admin.harga_barang.edit', compact('data', 'jenis_outlet','barang'));
    }

    public function update(Request $request, $id)
    {
        $data = HargaBarang::find($id);
        $request->validate(
            [
                'id_barang' => 'required|numeric',
                'tanggal' => 'required',
                'id_jenis_outlet' => 'required|numeric',
                'harga' => 'required|numeric',
            ],
            [                
                'harga.required' => 'Harga harus dipilih',
                'harga.numeric' => 'Harga harus dipilih',
                'barang_id.required' => 'Barang harus dipilih',
                'barang_id.numeric' => 'Barang harus dipilih',
                'tanggal.required' => 'Tanggal harus dipilih',
                'jenis_outlet_id.required' => 'Jenis Outlet harus dipilih',
                'jenis_outlet_id.numeric' => 'Jenis Outlet harus dipilih',
            ]
        );        
        $data->update([
            'id_barang' => $request->id_barang,
            'tanggal' => $request->tanggal,
            'id_jenis_outlet' => $request->id_jenis_outlet,  
            'harga' => $request->harga,  
        ]);

        return redirect()->route('admin.harga_barang')->with('success', 'Harga barang telah diubah');
    }

    public function destroy($id)
    {
        HargaBarang::find($id)->delete();
        return redirect()->route('admin.harga_barang')->with('success', 'Harga barang telah dihapus');
        
    }
}
