@extends('layouts.index')

@section('title')
Tambah Cluster
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div
        class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="text-s font-bold">Tambah Cluster</h6>
        </div>
        <div class="pb-6 pr-6 pl-6 flex-auto">
          <form action="{{ route('admin.barang.import_excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label class="mb-2 ml-1 text-sm font-sans text-slate-700">Pilih file excel</label>
              <input type="file" class="text-sm font-sans text-slate-700" name="file" required="required">
              @error('excel')
              <span id="FileHelp" class="text-sm font-sans text-slate-700 invalid-feedback" role="alert">
                <small>{{ $message }}</small>
              </span>
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