@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        {{ __('Edit Jenis Kebutuhan') }}
                    </h2>
                </header>

                <!-- Form Edit Jenis Kebutuhan -->
                <form action="{{ route('jenis-kebutuhan.update', $jenisKebutuhan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input Jenis Kebutuhan -->
                    <div class="mb-4">
                        <label for="jenis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Jenis Kebutuhan
                        </label>
                        <input type="text" name="jenis" id="jenis"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                               value="{{ old('jenis', $jenisKebutuhan->jenis) }}" required>
                        @error('jenis')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Simpan & Kembali -->
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('jenis-kebutuhan.index') }}"
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
