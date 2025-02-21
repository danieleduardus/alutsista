@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        {{ __('Edit Vendor') }}
                    </h2>
                </header>

                <!-- Form Edit Vendor -->
                <form action="{{ route('vendors.update', $vendor->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input Nama Vendor -->
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Vendor
                        </label>
                        <input type="text" name="nama" id="nama"
                               value="{{ old('nama', $vendor->nama) }}"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                               required>
                        @error('nama')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Alamat Vendor -->
                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Alamat Vendor
                        </label>
                        <textarea name="alamat" id="alamat"
                                  class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                                  required>{{ old('alamat', $vendor->alamat) }}</textarea>
                        @error('alamat')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input User ID -->
                    <div class="mb-4">
                        <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pengguna (User)
                        </label>
                        <select name="user_id" id="user_id"
                                class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                                required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $vendor->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Telepon Vendor -->
                    <div class="mb-4">
                        <label for="telepon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Telepon Vendor
                        </label>
                        <input type="text" name="telepon" id="telepon"
                               value="{{ old('telepon', $vendor->telepon) }}"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                               required>
                        @error('telepon')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Simpan & Kembali -->
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('vendors.index') }}"
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
