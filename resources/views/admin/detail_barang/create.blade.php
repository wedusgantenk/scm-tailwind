@extends('layouts.index')

@section('title')
Tambah Detail Barang
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div
        class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="text-s font-bold">Tambah Detail Barang</h6>
        </div>
        <div class="pb-6 pr-6 pl-6 flex-auto">

          <form action="{{ route('admin.detail_barang.store') }}" method="POST" enctype="multipart/form-data" role="form">
            @csrf
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Nama Barang</label>
            <div class="mb-4">
                <select class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="inputNamaBarang" name="id_barang" required>
                    <option value="">Pilih Nama Barang</option>
                    @foreach($nama_barang as $barang)
                        <option value="{{ $barang->id }}" {{ old('id') == $barang->id ? 'selected' : '' }}>{{ $barang->nama }}</option>
                    @endforeach
                </select>
                @error('kode_detail_barang')
                    <span id="detail_barang-addon" class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Kode Unik</label>
            <div class="mb-4">
              <input type="text"
                class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                id="inputDetailBarang" placeholder="Masukkan kode unik" aria-label="detail_barang"
                aria-describedby="detail_barang-addon" autocomplete="off" value="{{ old('kode_unik')}}" name="kode_unik" required>
              @error('kode_unik')
              <span id="detail_barang-addon" class="invalid-feedback" role="alert"></span>

              @enderror
            </div>

            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Status</label>
            <div class="mb-4">
                <select class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="inputStatus" name="status" required>
                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Non-Aktif</option>
                </select>
                @error('status')
                    <span id="detail_barang-addon" class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="text-center">
              <button type="submit"
                class="bg-slate-700 hover:bg-slate-500 inline-block w-1/5 px-6 py-3 mt-6 mb-6 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-fuchsia-700 to-pink-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85">Simpan</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection