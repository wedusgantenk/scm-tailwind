@extends('layouts.index')

@section('title')
    Outlet
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">
  <!-- table 1 -->

  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6>Outlet</h6>
        </div>
        <div class="flex flex-auto pl-6 py-2 col-md-4">
          <button class="py-1 px-2 mt-2 rounded-lg bg-slate-500 hover:bg-slate-700 text-white text-xs font-semibold drop-shadow-xl"  >
            <a href="{{ route('admin.outlet.create')}}">Tambah</a>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-0 overflow-x-auto">
            <table class="px-6 py-3 table-auto items-center w-full mb-0 align-top border-transparent border-gray-200 text-slate-600">
              <thead class="align-bottom">
                <tr>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nomor</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama</th>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                </tr>
              </thead>
              <tbody class="px-6 py-3 font-semibold text-left text-xs border-spacing-4">
                @forelse ($data as $d)
                  <tr>                                
                    <td class="w-16 text-center text-sm p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"> {{ $loop->iteration }}. </td>
                    <td class="text-sm px-6 py-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"> {{ $d->nama }} </td>                                
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                      <a href="{{ route('admin.outlet.edit', $d->id) }}"
                        class="mx-2 btn btn-success btn-xs"><i class="fas fa-edit fa-lg"></i></a>
                      <a href="{{ route('admin.outlet.delete', $d->id) }}"
                        class="mx-1 btn btn-danger btn-xs"
                        onclick="return confirm('Apakah yakin ingin menghapus outlet {{ $d->nama }} ?');"><i
                        class="fas fa-trash-alt fa-lg"></i></a>                                    
                      </td>
                  </tr>         
                    @empty
                    <tr>
                      <th colspan="3" class="p-2 text-center bg-transparent border-b whitespace-nowrap shadow-transparent">Tidak ada data</th>
                    </tr>
                @endforelse     
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection