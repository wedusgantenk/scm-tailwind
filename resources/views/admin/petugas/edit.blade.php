@extends('layouts.index')

@section('title')
    Edit Petugas
@endsection

@section('content')
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6 class="text-s font-bold">Edit Petugas</h6>
                    </div>
                    <div class="pb-6 pr-6 pl-6 flex-auto">
                        <form action="{{ route('admin.petugas.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data" role="form">
                            @csrf
                            @method('PATCH')
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Nama petugas</label>
                            <div class="mb-4">
                                <input type="text"
                                    class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-csite bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                    id="username" placeholder="Masukkan nama petugas" aria-label="petugas"
                                    aria-describedby="petugas-addon" autocomplete="off" value="{{ $data->username }}"
                                    name="username" required>
                                @error('username')
                                    <span id="username" class="invalid-feedback" role="alert"></span>
                                @enderror
                            </div>
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Hak Akses</label>
                            <div class="mb-4">
                                <select
                                    class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                    name="role" aria-describedby="clusterHelp" id="role" required
                                    onchange="showSubDropdown()">
                                    <option value="">-- Pilih --</option>                                    
                                    <option value="admin" {{ $data->hak_akses == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="cluster" {{ $data->hak_akses == 'cluster' ? 'selected' : '' }}>Cluster</option>
                                    <option value="depo" {{ $data->hak_akses == 'depo' ? 'selected' : '' }}>Depo</option>
                                </select>
                                @error('role')
                                    <span id="role" class="invalid-feedback" role="alert"></span>
                                @enderror
                            </div>
                            <label id="cluster_label" style="display: none;"
                                class="mb-2 ml-1 font-bold text-xs text-slate-700">Cluster</label>
                            <div class="mb-4">
                                <select style="display: none;"
                                    class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                    name="cluster_id" aria-describedby="clusterHelp" id="cluster_id">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($cluster as $cs)
                                        <option value="{{ $cs->id }}"  {{ $data->jenis == $cs->id && $data->hak_akses == 'cluster' ? 'selected' : '' }}>{{ $cs->nama }}</option>
                                    @endforeach
                                </select>
                                @error('cluster_id')
                                    <span id="clusterHelp" class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                            <label id="depo_label" style="display: none;"
                                class="mb-2 ml-1 font-bold text-xs text-slate-700">Depo</label>
                            <div class="mb-4">
                                <select style="display: none;"
                                    class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                    name="depo_id" aria-describedby="depoHelp" id="depo_id">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($depo as $cs)
                                        <option value="{{ $cs->id }}"  {{ $data->jenis == $cs->id && $data->hak_akses == 'depo' ? 'selected' : '' }}>{{ $cs->nama }}</option>
                                    @endforeach
                                </select>
                                @error('depo_id')
                                    <span id="depoHelp" class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Bagian</label>
                            <div class="mb-4">
                                <select
                                    class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                    name="bagian" aria-describedby="clusterHelp" id="bagian" required>
                                    <option value="0">-- Pilih --</option>
                                    <option value="keuangan" {{ $data->bagian == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                                    <option value="gudang" {{ $data->bagian == 'gudang' ? 'selected' : '' }}>Gudang</option>
                                </select>
                                @error('bagian')
                                    <span id="bagian_text" class="invalid-feedback" role="alert"></span>
                                @enderror
                            </div>
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Status</label>
                            <div class="mb-4">
                              <input id="aktif" name="aktif" value="1" class="w-5 h-5 ease-soft text-base -ml-7 rounded-1.4 checked:bg-gradient-to-tl checked:from-gray-900 checked:to-slate-800 after:text-xxs after:font-awesome after:duration-250 after:ease-soft-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-150 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100" type="checkbox" {{ $data->aktif ? 'checked' : '' }}/>
                              <label for="aktif" class="mb-2 ml-1 font-bold text-xs text-slate-700">Aktif</label>
                            </div>
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Password</label>
                            <div class="mb-4">
                                <input type="password"
                                    class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-csite bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                    id="password" placeholder="Masukkan password" aria-label="password"
                                    aria-describedby="password" autocomplete="off" value="{{ old('password') }}"
                                    name="password">
                                @error('password')
                                    <span id="password" class="invalid-feedback" role="alert"></span>
                                @enderror
                            </div>
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Masukkan Ulang Password</label>
                            <div class="mb-4">
                                <input type="password"
                                    class="flex-auto w-1/4 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-csite bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                    id="password_confirmation" placeholder="Masukkan ulang password" aria-label="password"
                                    aria-describedby="password" autocomplete="off"
                                    value="{{ old('password_confirmation') }}" name="password_confirmation">
                                @error('password_confirmation')
                                    <span id="password_confirmation" class="invalid-feedback" role="alert"></span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="bg-slate-700 hover:bg-slate-500 text-white inline-block w-1/5 px-6 py-3 mt-6 mb-6 font-bold text-center text-csite uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-fuchsia-700 to-pink-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js-tambahan')
    <script>
        function showSubDropdown() {
            var mainDropdown = document.getElementById("role");
            var clusterDropdown = document.getElementById("cluster_id");
            var clusterLabel = document.getElementById("cluster_label");
            var depoDropdown = document.getElementById("depo_id");
            var depoLabel = document.getElementById("depo_label");
            
            clusterDropdown.style.display = (mainDropdown.value === "cluster") ? "block" : "none";
            clusterLabel.style.display = (mainDropdown.value === "cluster") ? "block" : "none";
            depoDropdown.style.display = (mainDropdown.value === "depo") ? "block" : "none";
            depoLabel.style.display = (mainDropdown.value === "depo") ? "block" : "none";
        }
        showSubDropdown()
    </script>
@endsection
