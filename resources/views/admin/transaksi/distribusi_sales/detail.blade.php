@extends('layouts.index')

@section('title')
    Detail Distribusi ke Sales
@endsection

@section('content')
<div class="w-full px-6 py-6 mx-auto">
  <!-- table 1 -->

  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6>Detail Distribusi ke Sales</h6>
        </div>
                
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-0 overflow-x-auto">
            <table class="px-6 py-3 table-auto items-center w-full mb-0 align-top border-transparent border-gray-200 text-slate-600">
              <thead class="align-bottom">
                <tr>
                  <th class="font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap">Nomor</th>
                  <th class="font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap">Nama Barang</th>
                  <th class="font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-none whitespace-nowrap">ICCID</th>                  
                </tr>
              </thead>
              <tbody class="px-6 py-3 font-semibold text-left text-xs border-spacing-4">                
                @forelse ($data as $d)
                  <tr>                                
                    <td class="w-16 text-center"> {{ $loop->iteration }} </td>                    
                    <td> {{ $d->barang->nama }} </td>
                    <td> {{ $d->kode_unik }} </td>                                                                                
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