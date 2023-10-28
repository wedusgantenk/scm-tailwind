<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.petugas.create');
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
        
        Petugas::create([
            'username' => $request->username,            
            'hak_akses' => $request->role,        
            'password'  => Hash::make($request->password),                
        ]);        

        return redirect()->route('admin.petugas')->with('success', 'User '.$request->name.' telah ditambahkan');
    }

    public function destroy($id)
    {
        
        $data = Petugas::find($id);            
        $data->delete();
    
        return redirect()->route('admin.petugas')->with('success', 'User telah dihapus');
    }    

}
