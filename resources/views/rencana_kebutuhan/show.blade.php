@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 mb-5 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Detail Rencana Kebutuhan
                    </h2>
                </header>
            </div>
            <div class="p-6 mb-5 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Nomor Rencana Kebutuhan:</strong>
                    <p class="text-gray-900 dark:text-gray-100">{{ $rencanaKebutuhan->nomor }}</p>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Judul:</strong>
                    <p class="text-gray-900 dark:text-gray-100">{{ $rencanaKebutuhan->judul }}</p>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Jenis Kebutuhan:</strong>
                    <p class="text-gray-900 dark:text-gray-100">{{ $rencanaKebutuhan->jenisKebutuhan->jenis }}</p>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Prioritas Kebutuhan:</strong>
                    <p class="text-gray-900 dark:text-gray-100">{{ $rencanaKebutuhan->prioritasKebutuhan->prioritas }}</p>
                </div>
            </div>

            <div class="p-3 mb-5 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="">
                    <strong class="text-gray-700 dark:text-gray-300"><u>Deskripsi:</u></strong>
                    <div class="deskripsi text-gray-900 dark:text-gray-100">{!! $rencanaKebutuhan->deskripsi ?? '-' !!}</div>
                </div>
            </div>

            <div class="p-3 mb-5 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex justify-end">
                    <a href="{{ route('rencana-kebutuhan.edit', $rencanaKebutuhan->id) }}"
                    class="mr-3 px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600 transition">
                        Ubah
                    </a>
                    <a href="{{ route('rencana-kebutuhan.index') }}"
                       class="px-4 py-2 bg-gray-500 text-white text-sm font-medium rounded-lg hover:bg-gray-600 transition">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
