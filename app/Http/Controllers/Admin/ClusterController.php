<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cluster;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class ClusterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = cluster::all();
        return view('admin.cluster.index', compact('data'));        
    }

    public function create()
    {        
        return view('admin.cluster.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:cluster',
        ],
        [
            'nama.required' => 'Nama cluster harus diisi',
            'nama.unique' => 'cluster sudah ada',            
        ]);
        cluster::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,                     
        ]);
        return redirect()->route('admin.cluster')->with('success', 'cluster telah ditambahkan');
    }

    public function edit($id)
    {        
        $data = cluster::findorfail($id);
        return view('admin.cluster.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = cluster::find($id);
        $request->validate([
            'nama' => 'required',
        ],
        [
            'nama.required' => 'Nama cluster harus diisi',            
        ]);
        if ($data->nama != $request->nama) {
            $request->validate(
                [
                    'nama' => 'unique:cluster',
                ],
                [
                    'nama.unique' => 'nama cluster sudah ada',            
                ]
            );
        }
        $data->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,            
        ]);

        return redirect()->route('admin.cluster')->with('success', 'cluster telah diubah');
    }

    public function destroy($id)
    {
        cluster::find($id)->delete();
        return redirect()->route('admin.cluster')->with('success', 'cluster telah dihapus');
    }

    public function export()
    {
        $file = time() . 'data-warehouse.xlsx';
        return (new FastExcel(Cluster::all()))->download($file, function ($cluster) {
            return [
            'nama' => $cluster->nama,
            'alamat' => $cluster->alamat,
            ];
        });
    }

    public function import()
    {
        $clusters = (new FastExcel)->import('file.xlsx', function ($line){
        return Cluster::create([
            'nama' => $line['nama'],
            'alamat' => $line['alamat'],
            ]);
        });

    }
}
