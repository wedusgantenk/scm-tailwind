<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\BarangMasukImport;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\DetailBarang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;

class BarangMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = BarangMasuk::all();
        return view('admin.barang_masuk.index', compact('data'));
    }

    public function create()
    {
        $jenis_barang = JenisBarang::all();
        return view('admin.barang_masuk.create', compact('jenis_barang'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|unique:barang',
                'id_jenis' => 'required|numeric',
                'fisik' => ['in:1,0']
            ],
            [
                'nama.required' => 'Nama barang harus diisi',
                'nama.unique' => 'barang sudah ada',
                'id_jenis.required' => 'Jenis barang harus dipilih',
                'id_jenis.numeric' => 'Jenis barang harus dipilih',
            ]
        );
        BarangMasuk::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'id_jenis' => $request->id_jenis,
            'fisik' => $request->has('fisik'),
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('admin.barang_masuk')->with('success', 'barang telah ditambahkan');
    }

    public function edit($id)
    {
        $data = BarangMasuk::findorfail($id);
        $jenis_barang = JenisBarang::all();
        return view('admin.barang_masuk.edit', compact('data', 'jenis_barang'));
    }

    public function update(Request $request, $id)
    {
        $data = BarangMasuk::find($id);
        $request->validate(
            [
                'nama' => 'required',
                'id_jenis' => 'required|numeric',
                'fisik' => ['in:1,0']
            ],
            [
                'nama.required' => 'Nama barang harus diisi',
                'id_jenis.required' => 'Jenis barang harus dipilih',
                'id_jenis.numeric' => 'Jenis barang harus dipilih',
            ]
        );
        if ($data->nama != $request->nama) {
            $request->validate(
                [
                    'nama' => 'unique:barang',
                ],
                [
                    'nama.unique' => 'nama barang sudah ada',
                ]
            );
        }
        $data->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'id_jenis' => $request->id_jenis,
            'fisik' => $request->has('fisik'),
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.barang_masuk')->with('success', 'barang telah diubah');
    }

    public function destroy($id)
    {
        BarangMasuk::find($id)->delete();
        return redirect()->route('admin.barang_masuk')->with('success', 'barang telah dihapus');
    }

    public function import()
    {
        return view('admin.barang_masuk.import');
    }

    public function export()
    {
        $file = time() . '-Data Excell.xlsx';
        return (new FastExcel(BarangMasuk::all()))->download($file, function ($barangmasuk) {
            return [
            'nama' => $barangmasuk->nama,
            'alamat' => $barangmasuk->alamat,
            'id_jenis' => $barangmasuk->id_jenis,
            'fisik' => $barangmasuk->has('fisik'),
            'keterangan' => $barangmasuk->keterangan,
            ];
        });
    }
    
}
