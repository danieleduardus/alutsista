@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Edit Hak Akses
                    </h2>
                </header>

                <!-- Form Edit Hak Akses -->
                <form action="{{ route('hak-akses.update', $hakAkses->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input Nama Hak Akses -->
                    <div class="mb-4">
                        <label for="hak_akses" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Hak Akses
                        </label>
                        <input type="text" name="hak_akses" id="hak_akses"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                               value="{{ old('hak_akses', $hakAkses->hak_akses) }}" required>
                        @error('hak_akses')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Select Status -->
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Status Hak Akses
                        </label>
                        <select name="status" id="status"
                                class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100">
                            <option value="1" {{ $hakAkses->status == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $hakAkses->status == 0 ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Simpan & Kembali -->
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('hak-akses.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white text-sm font-medium rounded-lg hover:bg-gray-600 transition">
                            Kembali
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
