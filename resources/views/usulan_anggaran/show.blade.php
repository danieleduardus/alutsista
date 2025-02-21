@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            @if (session('error'))
                <div x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-transition.opacity.duration.500ms
                    class="mb-4 p-4 text-sm text-red-800 dark:text-red-200 bg-red-100 dark:bg-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Detail Usulan Anggaran</h2>
                </header>

                <!-- Informasi Usulan Anggaran -->
                <div class="mb-6">
                    <div class="mb-4">
                        <strong class="text-gray-700 dark:text-gray-300">Nomor Usulan Anggaran:</strong>
                        <p class="text-gray-900 dark:text-gray-100">{{ $usulanAnggaran->nomor }}</p>
                    </div>

                    <div class="mb-4">
                        <strong class="text-gray-700 dark:text-gray-300">Judul:</strong>
                        <p class="text-gray-900 dark:text-gray-100">{{ $usulanAnggaran->judul }}</p>
                    </div>

                    <div class="mb-4">
                        <strong class="text-gray-700 dark:text-gray-300">Jumlah Anggaran:</strong>
                        <p class="text-gray-900 dark:text-gray-100">Rp {{ number_format($usulanAnggaran->jumlah, 2, ',', '.') }}</p>
                    </div>

                    <div class="mb-4">
                        <strong class="text-gray-700 dark:text-gray-300">Realisasi Anggaran:</strong>
                        <p class="text-gray-900 dark:text-gray-100">
                            @if($usulanAnggaran->realisasi)
                                Rp {{ number_format($usulanAnggaran->realisasi, 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </p>
                    </div>

                    <div class="mb-4">
                        <strong class="text-gray-700 dark:text-gray-300">Status:</strong><br />
                        @if($usulanAnggaran->status_id == 2)
                            <span class="px-3 py-1 text-xs font-semibold text-green-700 dark:text-green-300 bg-green-200 dark:bg-green-700 rounded-md">{{ $usulanAnggaran->status->status }}</span>
                        @elseif($usulanAnggaran->status_id == 3)
                            <span class="px-3 py-1 text-xs font-semibold text-red-700 dark:text-red-300 bg-red-200 dark:bg-red-700 rounded-md">{{ $usulanAnggaran->status->status }}</span>
                        @else
                            <span class="px-3 py-1 text-xs font-semibold text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded-md">{{ $usulanAnggaran->status->status }}</span>
                        @endif
                    </div>
                </div>

                <!-- Rencana Kebutuhan yang Dicakup -->
                <div class="mb-6">
                    <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-2">Rencana Kebutuhan yang Dicakup</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">No</th>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Nomor</th>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Judul</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usulanAnggaran->rencanaKebutuhan as $index => $rencana)
                                    <tr class="text-gray-900 dark:text-gray-100">
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                            <a href="{{ route('rencana-kebutuhan.show', $rencana->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                                {{ $rencana->nomor }}
                                            </a>
                                        </td>
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">{{ $rencana->judul }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-between">
                    <!-- Tombol Setujui dan Tolak (di pojok kiri) -->
                    <div class="flex">
                        @if($usulanAnggaran->status_id == 1)
                        <form action="{{ route('usulan-anggaran.update-status', ['id' => $usulanAnggaran->id, 'status_id' => 2]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                    class="mr-3 px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-lg hover:bg-green-600 transition">
                                Setujui
                            </button>
                        </form>

                        <form action="{{ route('usulan-anggaran.update-status', ['id' => $usulanAnggaran->id, 'status_id' => 3]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                    class="mr-3 px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition">
                                Tolak
                            </button>
                        </form>
                        @endif
                    </div>

                    <!-- Tombol Ubah dan Kembali (di pojok kanan) -->
                    <div class="flex">
                        <a href="{{ route('usulan-anggaran.edit', $usulanAnggaran->id) }}"
                        class="mr-3 px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600 transition">
                            Ubah
                        </a>

                        <a href="{{ route('usulan-anggaran.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white text-sm font-medium rounded-lg hover:bg-gray-600 transition">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
