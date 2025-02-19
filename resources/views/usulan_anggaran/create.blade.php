@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Tambah Usulan Anggaran
                    </h2>
                </header>

                <!-- Form Tambah Usulan Anggaran -->
                <form action="{{ route('usulan-anggaran.store') }}" method="POST">
                    @csrf

                    <!-- Nomor Usulan Anggaran (Auto Generated) -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nomor Usulan Anggaran (Otomatis)
                        </label>
                        <div class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            {{ old('nomor', 'Nomor akan dibuat otomatis') }}
                        </div>
                    </div>

                    <!-- Input Judul -->
                    <div class="mb-4">
                        <label for="judul" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Judul Usulan Anggaran
                        </label>
                        <input type="text" name="judul" id="judul"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                               placeholder="Masukkan Judul Usulan Anggaran" required>
                        @error('judul')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Jumlah Anggaran -->
                    <div class="mb-4">
                        <label for="jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Jumlah Anggaran
                        </label>
                        <input type="number" step="0.01" name="jumlah" id="jumlah"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                               placeholder="Masukkan jumlah anggaran" required>
                        @error('jumlah')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pilihan Rencana Kebutuhan (Menggunakan Select2) -->
                    <div class="mb-4">
                        <label for="rencana_kebutuhan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Rencana Kebutuhan yang Dicakup
                        </label>
                        <select name="rencana_kebutuhan[]" id="rencana_kebutuhan" class="select2 w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100" multiple>
                            @foreach($rencanaKebutuhan as $item)
                                <option value="{{ $item->id }}">{{ $item->nomor }} - {{ $item->judul }}</option>
                            @endforeach
                        </select>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pilih satu atau lebih rencana kebutuhan.</p>
                        @error('rencana_kebutuhan')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Simpan & Kembali -->
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('usulan-anggaran.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white text-sm font-medium rounded-lg hover:bg-gray-600 transition">
                            Kembali
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Load Select2 JS -->
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

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                function updateSelect2Theme() {
                    if (document.documentElement.classList.contains('dark')) {
                        $('.select2-container--default .select2-selection--multiple').css({
                            'background-color': '#1e293b',
                            'border-color': '#334155',
                            'color': '#e5e7eb'
                        });
                        $('.select2-container--default .select2-results__option').css({
                            'background-color': '#1e293b',
                            'color': '#e5e7eb'
                        });
                        $('.select2-container--default .select2-dropdown').css({
                            'background-color': '#1e293b',
                            'border-color': '#334155',
                            'color': '#e5e7eb'
                        });
                    } else {
                        $('.select2-container--default .select2-selection--multiple').css({
                            'background-color': '#ffffff',
                            'border-color': '#ccc',
                            'color': '#000'
                        });
                        $('.select2-container--default .select2-results__option').css({
                            'background-color': '#ffffff',
                            'color': '#000'
                        });
                    }
                }

                // Update theme saat halaman dimuat
                updateSelect2Theme();

                // Pantau perubahan tema dark/light
                const observer = new MutationObserver(updateSelect2Theme);
                observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
            });
        </script>
    @endpush

@endsection
