<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisOutlet;
use Illuminate\Http\Request;

class JenisOutletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = JenisOutlet::all();
        return view('admin.jenis_outlet.index', compact('data'));
    }

    public function create()
    {
        return view('admin.jenis_outlet.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|unique:jenis_outlet',
            ],
            [
                'nama.required' => 'Nama jenis outlet harus diisi',
                'nama.unique' => 'Jenis outlet sudah ada',
            ]
        );
        JenisOutlet::create([
            'nama' => $request->nama,
        ]);
        return redirect()->route('admin.jenis_outlet')->with('success', 'Jenis outlet telah ditambahkan');
    }

    public function edit($id)
    {
        $data = JenisOutlet::findorfail($id);
        return view('admin.jenis_outlet.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = JenisOutlet::find($id);
        $request->validate(
            [
                'nama' => 'required',
            ],
            [
                'nama.required' => 'Nama jenis outlet harus diisi',
            ]
        );
        if ($data->nama != $request->nama) {
            $request->validate(
                [
                    'nama' => 'unique:jenis_outlet',
                ],
                [
                    'nama.unique' => 'Jenis outlet sudah ada',
                ]
            );
        }
        $data->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.jenis_outlet')->with('success', 'Jenis outlet telah diubah');
    }

    public function destroy($id)
    {
        JenisOutlet::find($id)->delete();
        return redirect()->route('admin.jenis_outlet')->with('success', 'Jenis outlet telah dihapus');
    }
}
