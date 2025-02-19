@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Daftar Usulan Anggaran
                    </h2>
                    <a href="{{ route('usulan-anggaran.create') }}"
                       class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                        Tambah Usulan Anggaran
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

                <!-- Tabel Data Usulan Anggaran -->
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 dark:border-gray-700 rounded-lg">
                        <thead class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            <tr>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">No</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">Nomor</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">Judul</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-right">Jumlah</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-right">Realisasi</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-900 dark:text-gray-100">
                            @forelse($usulanAnggaran as $item)
                            <tr class="border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                    <a href="{{ route('usulan-anggaran.show', $item->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                        {{ $item->nomor }}
                                    </a>
                                </td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">{{ $item->judul }}</td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-right">{{ number_format($item->jumlah, 2) }}</td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-right">{{ number_format($item->realisasi, 2) }}</td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('usulan-anggaran.edit', $item->id) }}"
                                           class="px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-md hover:bg-yellow-600 transition">
                                            Edit
                                        </a>

                                        <form action="{{ route('usulan-anggaran.destroy', $item->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition" onclick="return confirm('Hapus usulan anggaran ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                                    Tidak ada data usulan anggaran.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
