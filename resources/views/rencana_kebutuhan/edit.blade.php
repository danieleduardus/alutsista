@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        {{ __('Edit Rencana Kebutuhan') }}
                    </h2>
                </header>

                <!-- Form Edit Rencana Kebutuhan -->
                <form action="{{ route('rencana-kebutuhan.update', $rencanaKebutuhan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nomor Rencana Kebutuhan (Readonly) -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nomor Rencana Kebutuhan (Otomatis)
                        </label>
                        <div class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            {{ $rencanaKebutuhan->nomor }}
                        </div>
                    </div>

                    <!-- Input Judul -->
                    <div class="mb-4">
                        <label for="judul" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Judul Rencana Kebutuhan
                        </label>
                        <input type="text" name="judul" id="judul"
                               class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                               value="{{ old('judul', $rencanaKebutuhan->judul) }}" required>
                        @error('judul')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Select Jenis Kebutuhan -->
                    <div class="mb-4">
                        <label for="jenis_kebutuhan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Jenis Kebutuhan
                        </label>
                        <select name="jenis_kebutuhan_id" id="jenis_kebutuhan_id"
                                class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100" required>
                            <option value="">-- Pilih Jenis Kebutuhan --</option>
                            @foreach($jenisKebutuhan as $jenis)
                                <option value="{{ $jenis->id }}" {{ $rencanaKebutuhan->jenis_kebutuhan_id == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_kebutuhan_id')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Select Prioritas Kebutuhan (Readonly) -->
                    <div class="mb-4">
                        <label for="prioritas_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Prioritas Kebutuhan
                        </label>
                        <select name="prioritas_id" id="prioritas_id"
                                class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 cursor-not-allowed"
                                disabled>
                            @foreach($prioritasKebutuhan as $prioritas)
                                <option value="{{ $prioritas->id }}" {{ $rencanaKebutuhan->prioritas_id == $prioritas->id ? 'selected' : '' }}>
                                    {{ $prioritas->prioritas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Input Deskripsi -->
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Deskripsi Kebutuhan
                        </label>
                        <textarea name="deskripsi" id="deskripsi"
                                class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                                rows="4">{!! old('deskripsi', $rencanaKebutuhan->deskripsi) !!}</textarea>
                        @error('deskripsi')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- TinyMCE WYSIWYG -->
                    <script src="https://cdn.tiny.cloud/1/lm1ejaaxvpt9mec2dfmo2vyuh5scnb2qvl0k4hnpc79j91ei/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
                    <script>
                        tinymce.init({
                            selector: '#deskripsi',
                            menubar: false,
                            plugins: 'lists link image table code',
                            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table code',
                            content_css: 'dark', // Mode gelap
                            skin: 'oxide-dark',  // Tema gelap TinyMCE
                            height: 300,
                        });
                    </script>


                    <!-- Tombol Simpan & Kembali -->
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('rencana-kebutuhan.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white text-sm font-medium rounded-lg hover:bg-gray-600 transition">
                            Kembali
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
