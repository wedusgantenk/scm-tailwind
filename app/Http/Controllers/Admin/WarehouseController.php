<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = Warehouse::all();
        return view('admin.warehouse.index', compact('data'));        
    }

    public function create()
    {        
        return view('admin.warehouse.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:warehouse',
        ],
        [
            'nama.required' => 'Nama Warehouse harus diisi',
            'nama.unique' => 'Warehouse sudah ada',            
        ]);
        Warehouse::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,                     
        ]);
        return redirect()->route('admin.warehouse')->with('success', 'Warehouse telah ditambahkan');
    }

    public function edit($id)
    {        
        $data = Warehouse::findorfail($id);
        return view('admin.warehouse.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Warehouse::find($id);
        $request->validate([
            'nama' => 'required',
        ],
        [
            'nama.required' => 'Nama warehouse harus diisi',            
        ]);
        if ($data->nama != $request->nama) {
            $request->validate(
                [
                    'nama' => 'unique:warehouse',
                ],
                [
                    'nama.unique' => 'nama warehouse sudah ada',            
                ]
            );
        }
        $data->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,            
        ]);

        return redirect()->route('admin.warehouse')->with('success', 'Warehouse telah diubah');
    }

    public function destroy($id)
    {
        Warehouse::find($id)->delete();
        return redirect()->route('admin.warehouse')->with('success', 'Warehouse telah dihapus');
    }
}
