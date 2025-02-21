@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Daftar RFQ</h2>
                    <a href="{{ route('rfq.create') }}"
                       class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                        Tambah RFQ
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

                <!-- Tabel RFQ -->
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">No</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Nomor Usulan</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Tanggal Batas Pemenuhan</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Status</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($rfqs as $rfq)
                            <tr class="text-gray-900 dark:text-gray-100">
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                    <a href="{{ route('rfq.show', $rfq->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                        {{ $rfq->usulanAnggaran->nomor }}
                                    </a>
                                </td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">{{ $rfq->tanggal_batas_pemenuhan }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">{{ $rfq->status->status }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">
                                    <a href="{{ route('rfq.edit', $rfq->id) }}"
                                    class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600 transition">
                                        Ubah
                                    </a>

                                    <form action="{{ route('rfq.destroy', $rfq->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus RFQ ini?')"
                                                class="inline-flex items-center ml-2 px-3 py-1 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition">
                                            Hapus
                                        </button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $rfqs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
