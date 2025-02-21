@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Detail RFQ</h2>
                </header>

                <!-- Informasi RFQ -->
                <div class="mb-6">
                    <div class="mb-4">
                        <strong class="text-gray-700 dark:text-gray-300">Nomor Usulan Anggaran:</strong>
                        <p class="text-gray-900 dark:text-gray-100">{{ $rfq->usulanAnggaran->nomor }}</p>
                    </div>

                    <div class="mb-4">
                        <strong class="text-gray-700 dark:text-gray-300">Tanggal Batas Pemenuhan:</strong>
                        <p class="text-gray-900 dark:text-gray-100">{{ $rfq->tanggal_batas_pemenuhan }}</p>
                    </div>

                    <div class="mb-4">
                        <strong class="text-gray-700 dark:text-gray-300">Catatan Pengiriman:</strong>
                        <p class="text-gray-900 dark:text-gray-100">{{ $rfq->catatan_pengiriman ?? '-' }}</p>
                    </div>
                </div>

                <!-- Tabel RFQ Detail -->
                <div class="mb-6">
                    <h3 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-2">Daftar Barang</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">No</th>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Nama Barang</th>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Quantity</th>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Spesifikasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rfq->details as $detail)
                                    <tr class="text-gray-900 dark:text-gray-100">
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">{{ $detail->nama_barang }}</td>
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">{{ $detail->quantity }}</td>
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">{{ $detail->spesifikasi ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end">
                    <a href="{{ route('rfq.edit', $rfq->id) }}"
                       class="mr-3 px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600 transition">
                        Ubah
                    </a>
                    <a href="{{ route('rfq.index') }}"
                       class="px-4 py-2 bg-gray-500 text-white text-sm font-medium rounded-lg hover:bg-gray-600 transition">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
