<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\DetailBarang;
use App\Models\JenisOutlet;
use Illuminate\Http\Request;

class DetailBarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DetailBarang::with('barang', 'jenisOutlet')->get();
        return view('admin.detail_barang.index', compact('data'));
        
    }

    public function create()
    {
        $barang = Barang::all();
        $jenis_outlet = JenisOutlet::all();
        return view('admin.detail_barang.create', compact('jenis_outlet','barang'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'id_barang' => 'required|numeric',
                'tanggal' => 'required',
                'id_jenis_outlet' => 'required|numeric',
                'detail' => 'required|numeric',
            ],
            [                
                'detail.required' => 'Detail harus dipilih',
                'detail.numeric' => 'Detail harus dipilih',
                'barang_id.required' => 'Barang harus dipilih',
                'barang_id.numeric' => 'Barang harus dipilih',
                'tanggal.required' => 'Tanggal harus dipilih',
                'jenis_outlet_id.required' => 'Jenis Outlet harus dipilih',
                'jenis_outlet_id.numeric' => 'Jenis Outlet harus dipilih',
            ]
        );
        DetailBarang::create([
            'id_barang' => $request->id_barang,
            'tanggal' => $request->tanggal,
            'id_jenis_outlet' => $request->id_jenis_outlet,  
            'Detail' => $request->Detail,          
        ]);
        return redirect()->route('admin.Detail_barang')->with('success', 'Detail barang telah ditambahkan');
    }

    public function edit($id)
    {
        $data = DetailBarang::findorfail($id);
        $jenis_outlet = JenisOutlet::all();
        $barang = Barang::all();
        return view('admin.Detail_barang.edit', compact('data', 'jenis_outlet','barang'));
    }

    public function update(Request $request, $id)
    {
        $data = DetailBarang::find($id);
        $request->validate(
            [
                'id_barang' => 'required|numeric',
                'tanggal' => 'required',
                'id_jenis_outlet' => 'required|numeric',
                'Detail' => 'required|numeric',
            ],
            [                
                'Detail.required' => 'Detail harus dipilih',
                'Detail.numeric' => 'Detail harus dipilih',
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
            'Detail' => $request->Detail,  
        ]);

        return redirect()->route('admin.Detail_barang')->with('success', 'Detail barang telah diubah');
    }

    public function destroy($id)
    {
        DetailBarang::find($id)->delete();
        return redirect()->route('admin.Detail_barang')->with('success', 'Detail barang telah dihapus');
        
    }
}
