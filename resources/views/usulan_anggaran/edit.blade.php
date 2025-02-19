@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Edit Usulan Anggaran</h2>

                <form method="POST" action="{{ route('usulan-anggaran.update', $usulanAnggaran->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nomor Usulan (Readonly) -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nomor Usulan Anggaran (Otomatis)
                        </label>
                        <div class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            {{ $usulanAnggaran->nomor }}
                        </div>
                    </div>

                    <!-- Judul Usulan Anggaran -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Judul Usulan Anggaran</label>
                        <input type="text" name="judul" value="{{ old('judul', $usulanAnggaran->judul) }}" 
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:border-indigo-400" required>
                        @error('judul')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Jumlah Anggaran -->
                    <div class="mb-4">
                        <label for="jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Jumlah Anggaran
                        </label>
                        <input type="number" step="0.01" name="jumlah" id="jumlah" value="{{ old('jumlah', $usulanAnggaran->jumlah) }}"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                               placeholder="Masukkan jumlah anggaran" required>
                        @error('jumlah')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rencana Kebutuhan yang Dicakup -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rencana Kebutuhan yang Dicakup</label>
                        <select name="rencana_kebutuhan[]" id="rencana_kebutuhan" multiple required
                                class="w-full mt-1 select2 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-md">
                            @foreach($rencanaKebutuhan as $rencana)
                                <option value="{{ $rencana->id }}" 
                                    @if(in_array($rencana->id, $usulanAnggaran->rencanaKebutuhan->pluck('id')->toArray())) selected @endif>
                                    {{ $rencana->nomor }} - {{ $rencana->judul }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Pilih satu atau lebih rencana kebutuhan.</p>
                    </div>


                    <!-- Tombol Aksi -->
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('usulan-anggaran.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white text-sm font-medium rounded-lg hover:bg-gray-600 transition">
                            Kembali
                        </a>
                        <button type="submit"
                                class="ml-3 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#rencana_kebutuhan').select2({
                placeholder: "Pilih rencana kebutuhan",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endpush
