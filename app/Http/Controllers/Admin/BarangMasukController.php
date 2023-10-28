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

    public function import_excel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() ."_".$file->getClientOriginalName();

        // upload ke folder file barang di dalam folder public
        $file->move('file_barang', $nama_file);

        // import data
        $data = Excel::toCollection(new BarangMasukImport, public_path('/file_barang/' . $nama_file));        
        // return response()->json(["data" => $data_barang]);

        foreach ($data as $dat) {
            foreach ($dat as $d) {
                $data_barang = Barang::firstOrCreate([
                    'id_jenis' => 1,
                    'nama' => $d['item_name'],
                    'keterangan' => 'isi deskripsi produk',
                    'fisik' => 1,
                ]);
                $data_detail_barang = DetailBarang::firstOrCreate([
                    'id_barang'=>$data_barang['id'],
                    'kode_unik'=>$d['iccid'],                    
                ]);
                $data_barang_masuk = BarangMasuk::firstOrCreate([
                    'id_produk' => $data_barang['id'],
                    'id_petugas' => Auth::user()->id,
                    'tanggal' => $d['tgl_good_receive'],
                ]);                
            }
        }    

        // alihkan halaman kembali		
        return redirect()->route('admin.barang_masuk')->with('success', 'barang masuk telah ditambahkan');
    }
}
