<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bts;
use App\Models\Outlet;
use App\Models\JenisOutlet;
use App\Models\Depo;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Outlet::all();
        return view('admin.outlet.index', compact('data'));
    }

    public function create()
    {
        $bts = Bts::all();
        $jenis_outlet = JenisOutlet::all();
        $depo = Depo::all();
        return view('admin.outlet.create', compact('bts', 'jenis_outlet', 'depo'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|unique:outlet',
                'bts_id' => 'required|numeric',
                'jenis_id' => 'required|numeric',
                'depo_id' => 'required|numeric',
            ],
            [
                'nama.required' => 'Nama outlet harus diisi',
                'nama.unique' => 'outlet sudah ada',
                'bts_id.required' => 'bts harus dipilih',
                'bts_id.numeric' => 'bts harus dipilih',
                'jenis_id.required' => 'jenis harus dipilih',
                'jenis_id.numeric' => 'jenis harus dipilih',
                'depo_id.required' => 'depo harus dipilih',
                'depo_id.numeric' => 'depo harus dipilih',
            ]
        );
        Outlet::create([
            'nama' => $request->nama,            
            'id_bts' => $request->bts_id,
            'id_jenis' => $request->jenis_id,   
            'id_depo' => $request->depo_id,        
        ]);
        return redirect()->route('admin.outlet')->with('success', 'outlet telah ditambahkan');
    }

    public function edit($id)
    {
        $data = Outlet::findorfail($id);
        $bts = Bts::all();
        $jenis_outlet = JenisOutlet::all();
        $depo = Depo::all();
        return view('admin.outlet.edit', compact('data', 'bts', 'jenis_outlet', 'depo'));
    }

    public function update(Request $request, $id)
    {
        $data = Outlet::find($id);
        $request->validate(
            [
                'nama' => 'required',
                'bts_id' => 'required|numeric',
                'jenis_id' => 'required|numeric',
                'depo_id' => 'required|numeric',
            ],
            [
                'nama.required' => 'Nama outlet harus diisi',
                'bts_id.required' => 'bts harus dipilih',
                'bts_id.numeric' => 'bts harus dipilih',
                'jenis_id.required' => 'jenis harus dipilih',
                'jenis_id.numeric' => 'jenis harus dipilih',
                'depo_id.required' => 'depo harus dipilih',
                'depo_id.numeric' => 'depo harus dipilih',
            ]
        );
        if ($data->nama != $request->nama) {
            $request->validate(
                [
                    'nama' => 'unique:outlet',
                ],
                [
                    'nama.unique' => 'nama outlet sudah ada',
                ]
            );
        }
        $data->update([
            'nama' => $request->nama,            
            'id_bts' => $request->bts_id,
            'id_jenis' => $request->jenis_id, 
            'id_depo' => $request->depo_id, 
        ]);

        return redirect()->route('admin.outlet')->with('success', 'outlet telah diubah');
    }

    public function destroy($id)
    {
        Outlet::find($id)->delete();
        return redirect()->route('admin.outlet')->with('success', 'outlet telah dihapus');
    }
}
