<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bts;
use Illuminate\Http\Request;

class BtsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = Bts::all();
        return view('admin.bts.index', compact('data'));        
    }

    public function create()
    {        
        return view('admin.bts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:bts',
        ],
        [
            'nama.required' => 'Nama BTS harus diisi',
            'nama.unique' => 'BTS sudah ada',            
        ]);
        Bts::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'lang' => $request->lang,
            'lat' => $request->lat,            
        ]);
        return redirect()->route('admin.bts')->with('success', 'BTS telah ditambahkan');
    }

    public function edit($id)
    {        
        $data = Bts::findorfail($id);
        return view('admin.bts.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Bts::find($id);
        $request->validate([
            'nama' => 'required',
        ],
        [
            'nama.required' => 'Nama BTS harus diisi',            
        ]);
        if ($data->nama != $request->nama) {
            $request->validate(
                [
                    'nama' => 'unique:bts',
                ],
                [
                    'nama.unique' => 'Nama BTS sudah ada',            
                ]
            );
        }
        $data->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'lang' => $request->lang,
            'lat' => $request->lat,  
        ]);

        return redirect()->route('admin.bts')->with('success', 'BTS telah diubah');
    }

    public function destroy($id)
    {
        Bts::find($id)->delete();
        return redirect()->route('admin.bts')->with('success', 'BTS telah dihapus');
    }
}
