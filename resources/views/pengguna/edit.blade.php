@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Edit Pengguna
                    </h2>
                </header>

                <!-- Form Edit Pengguna -->
                <form action="{{ route('pengguna.update', $pengguna->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input Nama -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Pengguna
                        </label>
                        <input type="text" name="name" id="name"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                               value="{{ old('name', $pengguna->name) }}" required>
                        @error('name')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Email Pengguna
                        </label>
                        <input type="email" name="email" id="email"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                               value="{{ old('email', $pengguna->email) }}" required>
                        @error('email')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Password (Opsional) -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Password (Biarkan kosong jika tidak ingin mengubah)
                        </label>
                        <input type="password" name="password" id="password"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                               placeholder="Masukkan Password Baru (Opsional)">
                        @error('password')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Simpan & Kembali -->
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('pengguna.index') }}"
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
