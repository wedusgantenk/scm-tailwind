@extends('layouts.index')

@section('title')
Edit Cluster
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="text-s font-bold">Edit Barang {{$data->nama}}</h6>
        </div>
        <div class="pb-6 pr-6 pl-6 flex-auto">
        <form id="barang" action="{{ route('admin.barang.update', $data->id) }}" method="POST" enctype="multipart/form-data" role="form">
            @csrf
            @method('PATCH')
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Nama Barang</label>
            <div class="mb-4">
              <input type="text" class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="inputBarang" placeholder="Masukkan nama barang" aria-label="barang" aria-describedby="barang-addon" autocomplete="off" value="{{ $data->nama }}" name="nama" required>
              @error('nama')
              <span id="cluster-addon" class="invalid-feedback" role="alert"></span>
              @enderror
            </div>
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Jenis Barang</label>
            <div class="mb-3">
              <select class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" name="id_jenis" aria-describedby="btsHelp" id="id_jenis" required>
                <option value="">-- Pilih --</option>
                @foreach ($jenis_barang as $jenis)
                <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                @endforeach
              </select>
              @error('id_jenis')
              <span id="btsHelp" class="invalid-feedback" role="alert">
                <small>{{ $message }}</small>
              </span>
              @enderror
            </div>
            <div class="mt-4">
              <input id="fisik" name="fisik" value="1" class="w-5 h-5 ease-soft text-base -ml-7 rounded-1.4 checked:bg-gradient-to-tl checked:from-gray-900 checked:to-slate-800 after:text-xxs after:font-awesome after:duration-250 after:ease-soft-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100" type="checkbox" checked />
              <label for="fisik" class="mb-2 ml-1 font-bold text-xs text-slate-700">Fisik</label>
            </div>

            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Keterangan</label>
            <div class="mb-4">
              <textarea class="flex-auto resize-none focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Keterangan" aria-label="Alamat" aria-describedby="alamat-addon" name="keterangan" id="inputKeterangan" rows="3">{{ $data->keterangan }}</textarea>
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