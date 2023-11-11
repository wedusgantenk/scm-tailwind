<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\TransaksiSalesImport;
use App\Models\Barang;
use App\Models\Depo;
use App\Models\Sales;
use App\Models\TransaksiDepo;
use App\Models\TransaksiDepoDetail;
use App\Models\TransaksiSales;
use App\Models\TransaksiSalesDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiSalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = TransaksiSales::all();
        return view('admin.transaksi.distribusi_sales.index', compact('data'));
    }

    public function detail($id)
    {
        $data = TransaksiSalesDetail::where('id_transaksi', $id)->get();
        return view('admin.transaksi.distribusi_sales.detail', compact('data'));
    }

    public function import()
    {
        $depo = Depo::all();
        $sales = Sales::all();
        return view('admin.transaksi.distribusi_sales.import', compact('depo', 'sales'));
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
        $file->move('distribusi_sales', $nama_file);

        // import data
        $data = Excel::toCollection(new TransaksiSalesImport, public_path('/distribusi_sales/' . $nama_file));



        foreach ($data as $dat) {
            foreach ($dat as $d) {
                $barang = Barang::where('nama', $d['item_name'])->first();
                if ($barang) {
                    $id_depo = $request->depo_id;
                    $kode_unik = $d['iccid'];
                    
                    $barang_depo = TransaksiDepo::whereHas('details', function ($query) use ($kode_unik) {
                        $query->where('kode_unik', $kode_unik);
                    })->where('id_depo', $id_depo)->exists();
                    
                    if ($barang_depo) {
                        $transaksi = TransaksiSales::firstOrCreate([
                            'id_petugas' => Auth::user()->id,
                            'id_sales' => $request->sales_id,
                            'id_depo' => $request->depo_id,
                            'tanggal' => date('Y-m-d'),
                            'status' => '',
                        ]);

                        $data_detail = TransaksiSalesDetail::firstOrCreate([
                            'id_transaksi' => $transaksi->id,
                            'id_barang' => $barang->id,
                            'kode_unik' => $d['iccid'],
                        ]);
                    } else {
                        // tidak ada barang di depo yang dipilih
                    }
                } else {
                    // tidak ada barang
                }
            }
        }

        // alihkan halaman kembali		
        return redirect()->route('admin.transaksi.distribusi_sales')->with('success', 'barang masuk telah ditambahkan');
    }
}
