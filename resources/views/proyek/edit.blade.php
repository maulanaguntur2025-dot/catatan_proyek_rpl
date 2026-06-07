@extends('layouts.app')

@section('title', 'Edit Proyek')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Breadcrumb & Header -->
    <div class="mb-6">
        <a href="{{ route('proyek.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-indigo-400 hover:text-indigo-300 transition-colors mb-3">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar Proyek</span>
        </a>
        <h1 class="font-outfit text-2xl md:text-3xl font-extrabold text-white">Perbarui Catatan Proyek</h1>
        <p class="text-sm text-slate-400 mt-1">Ubah formulir di bawah untuk memperbarui catatan proyek Anda</p>
    </div>

    <!-- Form Panel -->
    <div class="glass-panel rounded-3xl p-6 md:p-8 border border-slate-800 shadow-2xl">
        
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm">
                <div class="font-semibold mb-2">Terjadi kesalahan input:</div>
                <ul class="list-disc list-inside space-y-1 text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('proyek.update', $proyek->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Proyek -->
            <div>
                <label for="nama_proyek" class="block text-sm font-semibold text-slate-300 mb-2">Nama Proyek <span class="text-rose-500">*</span></label>
                <input type="text" id="nama_proyek" name="nama_proyek" required max="100" value="{{ old('nama_proyek', $proyek->nama_proyek) }}"
                    class="block w-full px-4 py-3 bg-slate-900/50 border border-slate-700/60 rounded-xl text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    placeholder="Contoh: E-Commerce Toko Buku">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kategori / Jenis Proyek -->
                <div>
                    <label for="jenis_proyek" class="block text-sm font-semibold text-slate-300 mb-2">Jenis/Kategori Proyek <span class="text-rose-500">*</span></label>
                    <select id="jenis_proyek" name="jenis_proyek" required
                        class="block w-full px-4 py-3 bg-slate-900/50 border border-slate-700/60 rounded-xl text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        <option value="" disabled>Pilih Kategori</option>
                        <option value="Web" {{ old('jenis_proyek', $proyek->jenis_proyek) == 'Web' ? 'selected' : '' }}>Website / Web Application</option>
                        <option value="Mobile" {{ old('jenis_proyek', $proyek->jenis_proyek) == 'Mobile' ? 'selected' : '' }}>Mobile Application</option>
                        <option value="Desktop" {{ old('jenis_proyek', $proyek->jenis_proyek) == 'Desktop' ? 'selected' : '' }}>Desktop Application</option>
                        <option value="UI Design" {{ old('jenis_proyek', $proyek->jenis_proyek) == 'UI Design' ? 'selected' : '' }}>UI/UX Design</option>
                        <option value="Lainnya" {{ old('jenis_proyek', $proyek->jenis_proyek) == 'Lainnya' ? 'selected' : '' }}>Kategori Lainnya</option>
                    </select>
                </div>

                <!-- Teknologi -->
                <div>
                    <label for="teknologi" class="block text-sm font-semibold text-slate-300 mb-2">Teknologi / Framework <span class="text-rose-500">*</span></label>
                    <input type="text" id="teknologi" name="teknologi" required max="100" value="{{ old('teknologi', $proyek->teknologi) }}"
                        class="block w-full px-4 py-3 bg-slate-900/50 border border-slate-700/60 rounded-xl text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                        placeholder="Contoh: Laravel, Tailwind CSS, MySQL">
                </div>
            </div>

            <!-- Deskripsi Proyek -->
            <div>
                <label for="deskripsi" class="block text-sm font-semibold text-slate-300 mb-2">Deskripsi Singkat</label>
                <textarea id="deskripsi" name="deskripsi" rows="4"
                    class="block w-full px-4 py-3 bg-slate-900/50 border border-slate-700/60 rounded-xl text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    placeholder="Jelaskan mengenai tujuan, fitur utama, atau detail pengerjaan proyek ini...">{{ old('deskripsi', $proyek->deskripsi) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Status Proyek -->
                <div>
                    <label for="status_proyek" class="block text-sm font-semibold text-slate-300 mb-2">Status Proyek <span class="text-rose-500">*</span></label>
                    <select id="status_proyek" name="status_proyek" required
                        class="block w-full px-4 py-3 bg-slate-900/50 border border-slate-700/60 rounded-xl text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        <option value="Perencanaan" {{ old('status_proyek', $proyek->status_proyek) == 'Perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                        <option value="Proses" {{ old('status_proyek', $proyek->status_proyek) == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Revisi" {{ old('status_proyek', $proyek->status_proyek) == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                        <option value="Selesai" {{ old('status_proyek', $proyek->status_proyek) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <!-- Tanggal Mulai -->
                <div>
                    <label for="tanggal_mulai" class="block text-sm font-semibold text-slate-300 mb-2">Tanggal Mulai <span class="text-rose-500">*</span></label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" required value="{{ old('tanggal_mulai', $proyek->tanggal_mulai) }}"
                        class="block w-full px-4 py-3 bg-slate-900/50 border border-slate-700/60 rounded-xl text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>

                <!-- Tanggal Selesai -->
                <div>
                    <label for="tanggal_selesai" class="block text-sm font-semibold text-slate-300 mb-2">Tanggal Selesai (Target/Realisasi)</label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', $proyek->tanggal_selesai) }}"
                        class="block w-full px-4 py-3 bg-slate-900/50 border border-slate-700/60 rounded-xl text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-800/60">
                <a href="{{ route('proyek.index') }}" class="px-5 py-3 rounded-xl border border-slate-700 bg-slate-800/40 text-slate-300 hover:bg-slate-800 font-semibold text-sm transition-all">
                    Batal
                </a>
                <button type="submit" class="px-5 py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold text-sm shadow-lg shadow-indigo-500/20 transition-all duration-200 transform active:scale-95">
                    <i class="fa-solid fa-check mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
