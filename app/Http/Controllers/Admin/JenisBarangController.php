<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisBarang;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = JenisBarang::all();
        return view('admin.jenis_barang.index', compact('data'));
    }

    public function create()
    {
        return view('admin.jenis_barang.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|unique:jenis_barang',
            ],
            [
                'nama.required' => 'Nama jenis barang harus diisi',
                'nama.unique' => 'Jenis barang sudah ada',
            ]
        );
        JenisBarang::create([
            'nama' => $request->nama,
        ]);
        return redirect()->route('admin.jenis_barang')->with('success', 'Jenis barang telah ditambahkan');
    }

    public function edit($id)
    {
        $data = JenisBarang::findorfail($id);
        return view('admin.jenis_barang.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = JenisBarang::find($id);
        $request->validate(
            [
                'nama' => 'required',
            ],
            [
                'nama.required' => 'Nama jenis barang harus diisi',
            ]
        );
        if ($data->nama != $request->nama) {
            $request->validate(
                [
                    'nama' => 'unique:jenis_barang',
                ],
                [
                    'nama.unique' => 'Jenis barang sudah ada',
                ]
            );
        }
        $data->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.jenis_barang')->with('success', 'Jenis barang telah diubah');
    }

    public function destroy($id)
    {
        JenisBarang::find($id)->delete();
        return redirect()->route('admin.jenis_barang')->with('success', 'Jenis barang telah dihapus');
    }
}
