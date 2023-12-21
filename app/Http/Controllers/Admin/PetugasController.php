<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cluster;
use App\Models\Depo;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Petugas::all();
        return view('admin.petugas.index', compact('data'));
    }

    public function create()
    {
        $cluster = Cluster::all();
        $depo = Depo::all();
        return view('admin.petugas.create', compact('cluster','depo'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'username' => ['required', 'string', 'max:50'],
                'password' => ['required', 'string', 'min:5', 'confirmed'],
                'role' => ['required'],                                
            ],
            [
                'username.required' => 'Nama lengkap harus diisi',
                'username.string' => 'Nama lengkap harus diisi',
                'username.max' => 'Nama lengkap maksimal 50 karakter',
                'password.required' => 'Password harus diisi',
                'password.string' => 'Password harus diisi',
                'password.min' => 'Password minimal 5 karakter',
                'password.confirmed' => 'Password tidak sama dengan confirm password',
                'role.required' => 'Hak akses harus diisi',
            ]
        );

        $role = $request->role;
        
        if ($role == "admin") {
            $jenis = 0;
        }else if($role == "cluster") {
            $jenis = $request->cluster_id;
        }else{
            $jenis = $request->depo_id;
        }

        Petugas::create([
            'username' => $request->username,
            'hak_akses' => $request->role,
            'password'  => Hash::make($request->password),
            'jenis' => $jenis,
            'bagian' => $request->bagian,
            'aktif' => $request->has('aktif'),
        ]);

        return redirect()->route('admin.petugas')->with('success', 'User ' . $request->name . ' telah ditambahkan');
    }

    public function edit($id)
    {
        $data = Petugas::findorfail($id);
        $cluster = Cluster::all();
        $depo = Depo::all();
        return view('admin.petugas.edit', compact('data','cluster','depo'));
    }

    public function update(Request $request, $id)
    {
        $data = Petugas::find($id);
        if(isset($request->password)){
            $request->validate([
                'username' => ['required', 'string', 'max:50'],
                'password' => ['required', 'string', 'min:5', 'confirmed'],
                'role' => ['required'],            
            ]);
            $role = $request->role;
            
            if ($role == "admin") {
                $jenis = 0;
            }else if($role == "cluster") {
                $jenis = $request->cluster_id;
            }else{
                $jenis = $request->depo_id;
            }
    
            $data->update([
                'username' => $request->username,
                'hak_akses' => $request->role,
                'password'  => Hash::make($request->password),
                'jenis' => $jenis,
                'bagian' => $request->bagian,
                'aktif' => $request->has('aktif'),
            ]);
        }else{
            $request->validate([
                'username' => ['required', 'string', 'max:50'],                
                'role' => ['required'],            
            ]);
            $role = $request->role;
            
            if ($role == "admin") {
                $jenis = 0;
            }else if($role == "cluster") {
                $jenis = $request->cluster_id;
            }else{
                $jenis = $request->depo_id;
            }
    
            $data->update([
                'username' => $request->username,
                'hak_akses' => $request->role,                
                'jenis' => $jenis,
                'bagian' => $request->bagian,
                'aktif' => $request->has('aktif'),
            ]);
        }
        return redirect()->route('admin.petugas')->with('success', 'User ' . $request->name . ' telah dubah');
    }
    public function destroy($id)
    {

        $data = Petugas::find($id);
        $data->delete();

        return redirect()->route('admin.petugas')->with('success', 'User telah dihapus');
    }
}
