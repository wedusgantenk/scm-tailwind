<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depo;
use App\Models\Cluster;
use Illuminate\Http\Request;

class DepoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = depo::all();
        return view('admin.depo.index', compact('data'));
    }

    public function create()
    {
        $cluster = cluster::all();
        return view('admin.depo.create', compact('cluster'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|unique:depo',
                'cluster_id' => 'required|numeric',
            ],
            [
                'nama.required' => 'Nama depo harus diisi',
                'nama.unique' => 'depo sudah ada',
                'cluster_id.required' => 'cluster harus dipilih',
                'cluster_id.numeric' => 'cluster harus dipilih',
            ]
        );
        depo::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'id_cluster' => $request->cluster_id,            
        ]);
        return redirect()->route('admin.depo')->with('success', 'depo telah ditambahkan');
    }

    public function edit($id)
    {
        $data = depo::findorfail($id);
        $cluster = cluster::all();
        return view('admin.depo.edit', compact('data', 'cluster'));
    }

    public function update(Request $request, $id)
    {
        $data = depo::find($id);
        $request->validate(
            [
                'nama' => 'required',
                'cluster_id' => 'required|numeric',
            ],
            [
                'nama.required' => 'Nama depo harus diisi',
                'cluster_id.required' => 'cluster harus dipilih',
                'cluster_id.numeric' => 'cluster harus dipilih',
            ]
        );
        if ($data->nama != $request->nama) {
            $request->validate(
                [
                    'nama' => 'unique:depo',
                ],
                [
                    'nama.unique' => 'nama depo sudah ada',
                ]
            );
        }
        $data->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'id_cluster' => $request->cluster_id,
        ]);

        return redirect()->route('admin.depo')->with('success', 'depo telah diubah');
    }

    public function destroy($id)
    {
        depo::find($id)->delete();
        return redirect()->route('admin.depo')->with('success', 'depo telah dihapus');
    }
}
