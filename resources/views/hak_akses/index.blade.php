@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Master Data Hak Akses
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

                <!-- Tombol Tambah Hak Akses -->
                <div class="mb-4 flex justify-end">
                    <a href="{{ route('hak-akses.create') }}"
                       class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                        Tambah Hak Akses
                    </a>
                </div>

                <!-- Tabel Data Hak Akses -->
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 dark:border-gray-700 rounded-lg">
                        <thead class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            <tr>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">No</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">Nama Hak Akses</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">Status</th>
                                <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-900 dark:text-gray-100">
                            @foreach($hakAkses as $item)
                            <tr class="border border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">{{ $item->hak_akses }}</td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700 text-center">
                                    @if($item->status)
                                        <span class="px-3 py-1 text-sm font-medium bg-green-600 text-white rounded-lg">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-sm font-medium bg-red-600 text-white rounded-lg">
                                            Non-Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('hak-akses.edit', $item->id) }}"
                                           class="px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-md hover:bg-yellow-600 transition">
                                            Edit
                                        </a>

                                        <!-- Tombol Aktifkan/Nonaktifkan -->
                                        <form action="{{ route('hak-akses.toggle-status', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                    class="px-4 py-2 text-white text-sm font-medium rounded-md transition
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
