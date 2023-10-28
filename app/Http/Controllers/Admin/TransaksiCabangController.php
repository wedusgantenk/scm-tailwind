<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransaksiCabang;
use App\Models\TransaksiCabangDetail;
use Illuminate\Http\Request;

class TransaksiCabangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = TransaksiCabang::all();
        return view('admin.transaksi.distribusi_cabang.index', compact('data'));
    }

    public function create()
    {
        $status = TransaksiCabangDetail::all();
        return view('admin.transaksi.distribusi_cabang.create', compact('status'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|unique:transaksi',
                'status_id' => 'required|numeric',
            ],
            [
                'nama.required' => 'Nama transaksi harus diisi',
                'nama.unique' => 'transaksi sudah ada',
                'status_id.required' => 'Jenis transaksi harus dipilih',
                'status_id.numeric' => 'Jenis transaksi harus dipilih',
            ]
        );
        TransaksiCabang::create([
            'id_petugas' => $request->id_petugas,
            'id_warehouse' => $request->id_warehouse,
            'id_cabang' => $request->id_cabang,
            'tanggal' => $request->tanggal,
            'status' => $request->status,           
        ]);
        return redirect()->route('admin.transaksi.distribusi_cabang')->with('success', 'transaksi telah ditambahkan');
    }

    public function edit($id)
    {
        $data = TransaksiCabang::findorfail($id);
        $status = TransaksiCabangDetail::all();
        return view('<admin class="transaksi.distribusi_cabang"></admin>edit', compact('data', 'status'));
    }

    public function update(Request $request, $id)
    {
        $data = TransaksiCabang::find($id);
        $request->validate(
            [
                'nama' => 'required',
                'status_id' => 'required|numeric',
            ],
            [
                'nama.required' => 'Nama transaksi harus diisi',
                'status_id.required' => 'Jenis transaksi harus dipilih',
                'status_id.numeric' => 'Jenis transaksi harus dipilih',
            ]
        );
        if ($data->nama != $request->nama) {
            $request->validate(
                [
                    'nama' => 'unique:transaksi',
                ],
                [
                    'nama.unique' => 'nama transaksi sudah ada',
                ]
            );
        }
        $data->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'id_jenis' => $request->status_id,
        ]);

        return redirect()->route('admin.transaksi')->with('success', 'transaksi telah diubah');
    }

    public function destroy($id)
    {
        TransaksiCabangDetail::find($id)->delete();
        return redirect()->route('admin.transaksi')->with('success', 'transaksi telah dihapus');
    }
}
