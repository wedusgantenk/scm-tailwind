@extends('layouts.index')

@section('title')
Tambah Jenis Outlet
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="text-s font-bold">Tambah Jenis Outlet</h6>
        </div>
        <div class="pb-6 pr-6 pl-6 flex-auto">
          <form action="{{ route('admin.jenis_outlet.store') }}" method="POST" enctype="multipart/form-data" role="form">
            @csrf
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Jenis Outlet</label>
            <div class="mb-4">
              <input type="text" class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="inputjenisOutlet" placeholder="Masukkan jenis Outlet" aria-label="cluster" aria-describedby="cluster-addon" autocomplete="off" value="{{ old('nama')}}" name="nama" required>
              @error('nama')
              <span id="cluster-addon" class="invalid-feedback" role="alert"></span>
              @enderror
            </div>
            <div class="text-center">
              <button type="submit" class="bg-slate-700 hover:bg-slate-500 inline-block w-1/5 px-6 py-3 mt-6 mb-6 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-fuchsia-700 to-pink-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection