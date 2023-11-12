@extends('layouts.index')

@section('title')
Tambah Sales
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">
  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-depoite border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-depoite border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="text-s font-bold">Tambah Sales</h6>
        </div>
        <div class="pb-6 pr-6 pl-6 flex-auto">

          <form action="{{ route('admin.sales.store') }}" method="POST" enctype="multipart/form-data" role="form">
            @csrf
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Pilih Depo</label>
            <div class="mb-3">
              <select class="rounded-md text-sm form-control @error('id_depo') is-invalid @enderror" name="id_depo" aria-describedby="depoHelp" id="selectDepo" required>
                <option value="">-- Pilih --</option>
                @foreach ($depo as $dp)
                <option value="{{ $dp->id }}">{{ $dp->nama }}</option>
                @endforeach
              </select>
              @error('id_depo')
              <span id="depoHelp" class="invalid-feedback" role="alert">
                <small>{{ $message }}</small>
              </span>
              @enderror
            </div>
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Nama Sales</label>
            <div class="mb-4">
              <input type="text" class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-depoite bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="inputSales" placeholder="Masukkan nama Sales" aria-label="sales" aria-describedby="sales-addon" autocomplete="off" value="{{ old('nama')}}" name="nama" required>
              @error('nama')
              <span id="sales-addon" class="invalid-feedback" role="alert"></span>

              @enderror
            </div>
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
            <div class="mb-4">
              <input type="text" class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-depoite bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="inputoutlet" placeholder="Masukkan email" aria-label="sales" aria-describedby="sales-addon" autocomplete="off" value="{{ old('email')}}" name="email" required>
              @error('email')
              <span id="sales-addon" class="invalid-feedback" role="alert"></span>
              @enderror
            </div>
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Area</label>
            <div class="mb-4">
              <input type="text" class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-depoite bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="inputArea" placeholder="Masukkan area" aria-label="sales" aria-describedby="sales-addon" autocomplete="off" value="{{ old('area')}}" name="area" required>
              @error('area')
              <span id="sales-addon" class="invalid-feedback" role="alert"></span>
              @enderror
            </div>
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Password</label>
            <div class="mb-4">
              <input type="password" class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-depoite bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="inputPwd" placeholder="Masukkan Password" aria-label="sales" aria-describedby="sales-addon" autocomplete="off" value="{{ old('password')}}" name="password" required>
              @error('password')
              <span id="sales-addon" class="invalid-feedback" role="alert"></span>
              @enderror
            </div>
            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Status</label>
            <div class="mb-4">
              <input type="text" class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-depoite bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="inputStatus" placeholder="Masukkan area" aria-label="sales" aria-describedby="sales-addon" autocomplete="off" value="{{ old('status')}}" name="status" required>
              @error('status')
              <span id="sales-addon" class="invalid-feedback" role="alert"></span>
              @enderror
            </div>
            <div class="text-center">
              <button type="submit" class="bg-slate-700 hover:bg-slate-500 text-white inline-block w-1/5 px-6 py-3 mt-6 mb-6 font-bold text-center text-depoite uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-fuchsia-700 to-pink-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85">Simpan</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection