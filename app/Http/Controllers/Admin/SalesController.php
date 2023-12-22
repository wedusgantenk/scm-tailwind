<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depo;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SalesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Sales::join('depo', 'sales.id_depo', '=', 'depo.id')
        ->select('sales.*', 'depo.nama as nama_depo')
                ->get();

    return view('admin.sales.index', compact('data'));
    }

    public function create()
    {
        $depo = Depo::all();
        return view('admin.sales.create', compact('depo'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                // 'username' => ['required', 'string', 'max:50'],                
                // 'password' => ['required', 'string', 'min:5', 'confirmed'],
                // 'role' => ['required'],
                'nama' => ['required'],
                'email' => ['required'],
                'area' => ['required'],
                'password' => ['required'],
                'status' => ['required'],
                'id_depo' => ['required'],
            ]
            // [
            //     'username.required' => 'Nama lengkap harus diisi',
            //     'username.string' => 'Nama lengkap harus diisi',
            //     'username.max' => 'Nama lengkap maksimal 50 karakter',                
            //     'password.required' => 'Password harus diisi',    
            //     'password.string' => 'Password harus diisi',
            //     'password.min' => 'Password minimal 5 karakter',
            //     'password.confirmed' => 'Password tidak sama dengan confirm password',     
            //     'role.required' => 'Hak akses harus diisi',                       
            // ]            
        );
        
        Sales::create([
            // 'username' => $request->username,            
            // 'hak_akses' => $request->role,        
            // 'password'  => Hash::make($request->password),        

                'nama' => $request->nama,
                'email' => $request->email,
                'area' => $request->area,
                'password' => $request->password,
                'status' => $request->status,
                'id_depo' => $request->id_depo,
    
        ]);        

        return redirect()->route('admin.sales')->with('success', 'User '.$request->name.' telah ditambahkan');
    }

    public function edit($id)
    {
        $data = Sales::findorfail($id);
        $depo = Depo::all();
        return view('admin.sales.edit', compact('data', 'depo'));

    }

    public function update(Request $request, $id)
    {
        $data = Sales::find($id);
        $request->validate([
                'nama' => ['required'],
                'email' => ['required'],
                'area' => ['required'],
                'password' => ['required'],
                'status' => ['required'],
                'id_depo' => ['required'],
            ]);
            $data->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'area' => $request->area,
                'password' => $request->password,
                'status' => $request->status,
                'id_depo' => $request->id_depo,
            ]);
            return redirect()->route('admin.sales')->with('success', 'sales telah diubah');
    }

    public function destroy($id)
    {
        
        $data = Sales::find($id);            
        $data->delete();
    
        return redirect()->route('admin.sales')->with('success', 'User telah dihapus');
    }    

}
