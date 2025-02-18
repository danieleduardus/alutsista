@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        {{ __('Daftar Jenis Kebutuhan') }}
                    </h2>
                </header>

                <!-- Notifikasi sukses -->
                @if (session('success'))
                    <div x-data="{ show: true }"
                        x-init="setTimeout(() => show = false, 3000)"
                        x-show="show"
                        x-transition.opacity.duration.500ms
                        class="mb-4 p-4 text-sm text-green-800 dark:text-green-200 bg-green-100 dark:bg-green-800 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif



                <!-- Tombol Tambah -->
                <div class="mb-4">
                    <a href="{{ route('jenis-kebutuhan.create') }}"
                       class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                        Tambah Jenis Kebutuhan
                    </a>
                </div>

                <!-- Tabel Jenis Kebutuhan -->
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 dark:border-gray-700 rounded-lg">
                        <thead class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            <tr>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">No</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">Jenis Kebutuhan</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">Status</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-900 dark:text-gray-100">
                            @foreach($jenisKebutuhan as $item)
                            <tr class="border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">{{ $item->jenis }}</td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-center">
                                    @if($item->status)
                                        <span class="px-3 py-1 text-xs font-semibold text-green-700 dark:text-green-300 bg-green-200 dark:bg-green-700 rounded-md">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold text-red-700 dark:text-red-300 bg-red-200 dark:bg-red-700 rounded-md">
                                            Non-Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('jenis-kebutuhan.edit', $item->id) }}"
                                        class="px-3 py-1 bg-yellow-500 text-white text-sm font-medium rounded-md hover:bg-yellow-600 transition">
                                            Ubah
                                        </a>

                                        <!-- Tombol Aktifkan / Non-aktifkan -->
                                        <form action="{{ route('jenis-kebutuhan.toggle-status', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="px-3 py-1 text-white text-sm font-medium rounded-md transition
                                                    {{ $item->status ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}">
                                                {{ $item->status ? 'Non-Aktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
