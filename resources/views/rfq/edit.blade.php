@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Edit RFQ</h2>

                <form method="POST" action="{{ route('rfq.update', $rfq->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Usulan Anggaran -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Usulan Anggaran</label>
                        <input type="text" value="{{ $rfq->usulanAnggaran->nomor }}" disabled
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-300">
                    </div>

                    <!-- Tanggal Batas Pemenuhan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Batas Pemenuhan</label>
                        <input type="date" name="tanggal_batas_pemenuhan" required value="{{ $rfq->tanggal_batas_pemenuhan }}"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    </div>

                    <!-- Catatan Pengiriman -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catatan Pengiriman</label>
                        <textarea name="catatan_pengiriman" rows="3"
                                  class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">{{ $rfq->catatan_pengiriman }}</textarea>
                    </div>

                    <!-- RFQ Detail (Tabel) -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Daftar Barang</label>
                        <table class="w-full border-collapse border border-gray-300 dark:border-gray-700 mt-2">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Nama Barang</th>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Quantity</th>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Spesifikasi</th>
                                    <th class="border border-gray-300 dark:border-gray-700 px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="rfq-details-body">
                                @foreach ($rfq->details as $index => $detail)
                                    <tr class="text-gray-900 dark:text-gray-100">
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                            <input type="text" name="rfq_details[{{ $index }}][nama_barang]" required value="{{ $detail->nama_barang }}"
                                                   class="w-full px-2 py-1 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                        </td>
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                            <input type="number" name="rfq_details[{{ $index }}][quantity]" required min="1" value="{{ $detail->quantity }}"
                                                   class="w-full px-2 py-1 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                        </td>
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                            <textarea name="rfq_details[{{ $index }}][spesifikasi]" rows="2"
                                                      class="w-full px-2 py-1 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">{{ $detail->spesifikasi }}</textarea>
                                        </td>
                                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">
                                            <button type="button" onclick="removeRow(this)"
                                                    class="px-3 py-1 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <button type="button" onclick="addRow()"
                                class="mt-3 px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-lg hover:bg-green-600 transition">
                            Tambah Barang
                        </button>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('rfq.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white text-sm font-medium rounded-lg hover:bg-gray-600 transition">
                            Kembali
                        </a>
                        <button type="submit"
                                class="ml-3 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let rowIndex = {{ count($rfq->details) }};

        function addRow() {
            let tbody = document.getElementById('rfq-details-body');
            let row = document.createElement('tr');
            row.classList.add('text-gray-900', 'dark:text-gray-100');

            row.innerHTML = `
                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                    <input type="text" name="rfq_details[${rowIndex}][nama_barang]" required
                           class="w-full px-2 py-1 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                </td>
                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                    <input type="number" name="rfq_details[${rowIndex}][quantity]" required min="1"
                           class="w-full px-2 py-1 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                </td>
                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                    <textarea name="rfq_details[${rowIndex}][spesifikasi]" rows="2"
                              class="w-full px-2 py-1 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"></textarea>
                </td>
                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">
                    <button type="button" onclick="removeRow(this)"
                            class="px-3 py-1 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition">
                        Hapus
                    </button>
                </td>
            `;

            tbody.appendChild(row);
            rowIndex++;
        }

        function removeRow(button) {
            button.closest('tr').remove();
        }
    </script>
@endpush
