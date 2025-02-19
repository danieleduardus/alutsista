@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Tambah Hak Akses
                    </h2>
                </header>

                <!-- Form Tambah Hak Akses -->
                <form action="{{ route('hak-akses.store') }}" method="POST">
                    @csrf

                    <!-- Input Nama Hak Akses -->
                    <div class="mb-6">
                        <label for="hak_akses" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Hak Akses
                        </label>
                        <input type="text" name="hak_akses" id="hak_akses"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                               placeholder="Masukkan Nama Hak Akses" required>
                        @error('hak_akses')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Layout 2 Kolom -->
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Kolom Akses Menu -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Akses Menu
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @foreach(['menu_master_data' => 'Master Data', 'menu_rencana_kebutuhan' => 'Rencana Kebutuhan', 'menu_usulan_anggaran' => 'Usulan Anggaran', 'menu_rfq' => 'RFQ', 'menu_kontrak' => 'Kontrak'] as $key => $label)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="{{ $key }}" id="{{ $key }}" value="1"
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <label for="{{ $key }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Kolom Kewenangan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Kewenangan
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @foreach([
                                    'mengelola_master_data' => 'Mengelola Master Data',
                                    'membuat_rencana_kebutuhan' => 'Membuat Rencana Kebutuhan',
                                    'menentukan_prioritas_rencana_kebutuhan' => 'Menentukan Prioritas Rencana Kebutuhan',
                                    'membuat_usulan_anggaran' => 'Membuat Usulan Anggaran',
                                    'mengubah_usulan_anggaran' => 'Mengubah Usulan Anggaran',
                                    'menyetujui_usulan_anggaran' => 'Menyetujui Usulan Anggaran',
                                    'membuat_rfq' => 'Membuat RFQ',
                                    'mengubah_rfq' => 'Mengubah RFQ',
                                    'menyetujui_dan_mempublikasikan_rfq' => 'Menyetujui & Publikasi RFQ',
                                    'memilih_vendor_dan_penawaran' => 'Memilih Vendor & Penawaran',
                                    'menandatangani_kontrak' => 'Menandatangani Kontrak'
                                ] as $key => $label)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="{{ $key }}" id="{{ $key }}" value="1"
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <label for="{{ $key }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Simpan & Kembali -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <a href="{{ route('hak-akses.index') }}"
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
@endsection
