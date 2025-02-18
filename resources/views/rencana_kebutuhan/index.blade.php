@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="mb-4 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        {{ __('Daftar Rencana Kebutuhan') }}
                    </h2>
                    <!-- Tombol Tambah -->
                    <a href="{{ route('rencana-kebutuhan.create') }}"
                       class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                        Tambah Rencana Kebutuhan
                    </a>
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

                <!-- Tabel Rencana Kebutuhan -->
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 dark:border-gray-700 rounded-lg">
                        <thead class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            <tr>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">No</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">Nomor</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">Judul</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">Jenis Kebutuhan</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">Prioritas</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-900 dark:text-gray-100">
                            @foreach($rencanaKebutuhan as $item)
                            <tr class="border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                    <a href="{{ route('rencana-kebutuhan.show', $item->id) }}" 
                                    class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                        {{ $item->nomor }}
                                    </a>
                                </td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                    <a href="{{ route('rencana-kebutuhan.show', $item->id) }}" 
                                    class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                        {{ $item->judul }}
                                    </a>
                                </td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">{{ $item->jenisKebutuhan->jenis }}</td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">{{ $item->prioritasKebutuhan->prioritas }}</td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('rencana-kebutuhan.edit', $item->id) }}"
                                        class="px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-md hover:bg-yellow-600 transition">
                                            Edit
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('rencana-kebutuhan.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition">
                                                Hapus
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
