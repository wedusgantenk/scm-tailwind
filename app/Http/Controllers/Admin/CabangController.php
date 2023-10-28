<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Cabang::all();
        return view('admin.cabang.index', compact('data'));
    }

    public function create()
    {
        $warehouse = Warehouse::all();
        return view('admin.cabang.create', compact('warehouse'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|unique:cabang',
                'warehouse_id' => 'required|numeric',
            ],
            [
                'nama.required' => 'Nama cabang harus diisi',
                'nama.unique' => 'cabang sudah ada',
                'warehouse_id.required' => 'Warehouse harus dipilih',
                'warehouse_id.numeric' => 'Warehouse harus dipilih',
            ]
        );
        Cabang::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'id_warehouse' => $request->warehouse_id,            
        ]);
        return redirect()->route('admin.cabang')->with('success', 'cabang telah ditambahkan');
    }

    public function edit($id)
    {
        $data = Cabang::findorfail($id);
        $warehouse = Warehouse::all();
        return view('admin.cabang.edit', compact('data', 'warehouse'));
    }

    public function update(Request $request, $id)
    {
        $data = Cabang::find($id);
        $request->validate(
            [
                'nama' => 'required',
                'warehouse_id' => 'required|numeric',
            ],
            [
                'nama.required' => 'Nama cabang harus diisi',
                'warehouse_id.required' => 'Warehouse harus dipilih',
                'warehouse_id.numeric' => 'Warehouse harus dipilih',
            ]
        );
        if ($data->nama != $request->nama) {
            $request->validate(
                [
                    'nama' => 'unique:cabang',
                ],
                [
                    'nama.unique' => 'nama cabang sudah ada',
                ]
            );
        }
        $data->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'id_warehouse' => $request->warehouse_id,
        ]);

        return redirect()->route('admin.cabang')->with('success', 'cabang telah diubah');
    }

    public function destroy($id)
    {
        Cabang::find($id)->delete();
        return redirect()->route('admin.cabang')->with('success', 'cabang telah dihapus');
    }
}
