@extends('layouts.index')

@section('title')
    Daftar Barang Masuk
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">
  <!-- table 1 -->

  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6>Barang Masuk</h6>
        </div>
        
        <div class="flex flex-auto pl-6 py-2">          
            <button class="py-1 px-2 rounded-lg bg-slate-500 hover:bg-slate-700 text-white text-xs font-semibold drop-shadow-xl"  >
              <a href="{{ route('admin.barang_masuk.import') }}">
              Import Barang <i class="fa fa-upload"></i></a></button>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-0 overflow-x-auto">
            <table class="px-6 py-3 table-auto items-center w-full mb-0 align-top border-transparent border-gray-200 text-slate-600">
              <thead class="align-bottom">
                <tr>
                  <th class="font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap">Nomor</th>
                  <th class="font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap">Tanggal</th>
                  <th class="font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap">Nama Barang</th>
                  <th class="font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap">Nomor DO</th>
                  <th class="font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap">Nomor PO</th>
                  <th class="font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap">Petugas</th>
                  <th class="font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap">Aksi</th>
                </tr>
              </thead>
              <tbody class="px-6 py-3 font-semibold text-left text-xs border-spacing-4">
                @forelse ($data as $d)
                  <tr>                                
                    <td class="w-16 text-center"> {{ $loop->iteration }} </td>
                    <td> {{ AppHelper::instance()->convertDate($d->tanggal) }} </td>  
                    <td> {{ $d->barang->nama }} </td>
                    <td> {{ $d->no_do }} </td>
                    <td> {{ $d->no_po }} </td>
                    <td> {{ $d->petugas->username }} </td>
                    
                    <td>
                      <a href="{{ route('admin.barang_masuk.edit', $d->id) }}"
                        class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
                      <a href="{{ route('admin.barang_masuk.delete', $d->id) }}"
                        class="btn btn-danger btn-xs"
                        onclick="return confirm('Apakah yakin ingin menghapus cluster : {{ $d->nama }} ?');"><i
                        class="fa fa-trash"></i></a>                                    
                      </td>
                  </tr>         
                    @empty
                    <tr>
                      <th colspan="3" class="text-center">Tidak ada data</th>
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