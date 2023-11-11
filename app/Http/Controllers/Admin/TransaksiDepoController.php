<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\TransaksiDepoImport;
use App\Models\Barang;
use App\Models\Cluster;
use App\Models\Depo;
use App\Models\TransaksiDepo;
use App\Models\TransaksiDepoDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiDepoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = TransaksiDepo::all();
        return view('admin.transaksi.distribusi_depo.index', compact('data'));
    }  
    
    public function detail($id)
    {
        $data = TransaksiDepoDetail::where('id_transaksi', $id)->get();           
        return view('admin.transaksi.distribusi_depo.detail', compact('data'));
    } 

    public function import()
    {
        $cluster = Cluster::all();
        $depo = Depo::all();
        return view('admin.transaksi.distribusi_depo.import', compact('cluster', 'depo'));
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
        $nama_file = rand() . "_" . $file->getClientOriginalName();

        // upload ke folder file barang di dalam folder public
        $file->move('distribusi_depo', $nama_file);

        // import data
        $data = Excel::toCollection(new TransaksiDepoImport, public_path('/distribusi_depo/' . $nama_file));

        $transaksi = TransaksiDepo::create([
            'id_petugas' => Auth::user()->id,
            'id_cluster' => $request->cluster_id,
            'id_depo' => $request->depo_id,
            'tanggal' => date('Y-m-d'),
            'status' => '',
        ]);

        foreach ($data as $dat) {
            foreach ($dat as $d) {
                $barang = Barang::where('nama', $d['item_name'])->first();                
                if ($barang) {                    
                    $data_detail = TransaksiDepoDetail::firstOrCreate([
                        'id_transaksi' => $transaksi->id,
                        'id_barang' => $barang->id,
                        'kode_unik' => $d['iccid'],
                    ]);
                } else {
                    // tidak ada barang
                }                
            }
        }

        // alihkan halaman kembali		
        return redirect()->route('admin.transaksi.distribusi_depo')->with('success', 'barang masuk telah ditambahkan');
    }
}
