@extends('layouts.index')

@section('title')
Edit Petugas
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="text-s font-bold">Edit Petugas</h6>
        </div>
        <div class="pb-6 pr-6 pl-6 flex-auto">
          <form action="{{ route('admin.petugas.update', $data->id) }}" method="POST" enctype="multipart/form-data" role="form">
            @csrf
            @method('PATCH')
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Nama petugas</label>
            <div class="mb-4">
              <input type="text" class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-csite bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="username" placeholder="Masukkan nama petugas" aria-label="petugas" aria-describedby="petugas-addon" autocomplete="off" 
              value="{{ $data->username }}" name="username" required>
              @error('username')
              <span id="username" class="invalid-feedback" role="alert"></span>
              @enderror
            </div>
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Hak Akses</label>
            <div class="mb-3">
              <select class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" name="role" aria-describedby="clusterHelp" id="role" required>
                <option value="">-- Pilih --</option>
                <option value="admin">Admin</option>
                <option value="cabang">Cabang</option>
                <option value="warehouse">Warehouse</option>
              </select>
              @error('role')
              <span id="role" class="invalid-feedback" role="alert"></span>
              @enderror
            </div>
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Password</label>
            <div class="mb-4">
              <input type="password" class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-csite bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="password" placeholder="Masukkan password" aria-label="password" aria-describedby="password" autocomplete="off" value="{{ old('password')}}" name="password" required>
              @error('password')
              <span id="password" class="invalid-feedback" role="alert"></span>
              @enderror
            </div>
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Masukkan Ulang Password</label>
            <div class="mb-4">
              <input type="text" class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-csite bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="password_confirmation" placeholder="Masukkan ulang password" aria-label="password" aria-describedby="password" autocomplete="off" value="{{ old('password_confirmation')}}" name="password_confirmation" required>
              @error('password_confirmation')
              <span id="password_confirmation" class="invalid-feedback" role="alert"></span>
              @enderror
            </div>
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Jenis</label>
            <div class="mb-4">
              <input type="text" class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-csite bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="jenis" placeholder="Masukkan nama petugas" aria-label="petugas" aria-describedby="petugas-addon" autocomplete="off" value="{{ old('jenis')}}" name="jenis" required>
              @error('jenis')
              <span id="peptugas" class="invalid-feedback" role="alert"></span>
              @enderror
            </div>
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Bagian</label>
            <div class="mb-4">
              <input type="text" class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-csite bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="bagiane" placeholder="Masukkan nama petugas" aria-label="petugas" aria-describedby="petugas-addon" autocomplete="off" value="{{ old('bagian')}}" name="bagian" required>
              @error('username')
              <span id="username" class="invalid-feedback" role="alert"></span>
              @enderror
            </div>
            <div class="text-center">
              <button type="submit" class="bg-slate-700 hover:bg-slate-500 text-white inline-block w-1/5 px-6 py-3 mt-6 mb-6 font-bold text-center text-csite uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-fuchsia-700 to-pink-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection