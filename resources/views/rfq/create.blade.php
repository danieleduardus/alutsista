@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Tambah RFQ</h2>

                <form method="POST" action="{{ route('rfq.store') }}">
                    @csrf

                    <!-- Usulan Anggaran -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Usulan Anggaran</label>
                        <select name="usulan_anggaran_id" required
                                class="w-full mt-1 select2 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-md">
                            <option value="">-- Pilih Usulan Anggaran --</option>
                            @foreach($usulanAnggaran as $usulan)
                                <option value="{{ $usulan->id }}">{{ $usulan->nomor }} - {{ $usulan->judul }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal Batas Pemenuhan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Batas Pemenuhan</label>
                        <input type="date" name="tanggal_batas_pemenuhan" required
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:border-indigo-400">
                    </div>

                    <!-- Catatan Pengiriman -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catatan Pengiriman</label>
                        <textarea name="catatan_pengiriman" rows="3"
                                  class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:border-indigo-400"></textarea>
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
                                <tr class="text-gray-900 dark:text-gray-100">
                                    <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                        <input type="text" name="rfq_details[0][nama_barang]" required
                                            class="w-full px-2 py-1 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                        <input type="number" name="rfq_details[0][quantity]" required min="1"
                                            class="w-full px-2 py-1 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">
                                        <textarea name="rfq_details[0][spesifikasi]" rows="2"
                                                class="w-full px-2 py-1 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100"></textarea>
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">
                                        <button type="button" onclick="removeRow(this)"
                                                class="px-3 py-1 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
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
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let rowIndex = 1;

        function addRow() {
            let tbody = document.getElementById('rfq-details-body');
            let rowIndex = tbody.children.length;
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
        }


        function removeRow(button) {
            button.closest('tr').remove();
        }
    </script>
@endpush
