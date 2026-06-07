@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Hero Welcome Section -->
<div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-900/40 via-purple-900/30 to-slate-900/40 border border-indigo-500/20 p-6 md:p-8 mb-8">
    <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">Selamat Datang Kembali</span>
            <h1 class="font-outfit text-3xl md:text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-slate-300 mt-1">
                {{ $user->name }}
            </h1>
            <p class="text-slate-400 text-sm md:text-base mt-2 max-w-xl">
                Catat, kelola, dan pantau kemajuan seluruh proyek pembelajaran RPL Anda secara terstruktur dan aman.
            </p>
        </div>
        <div>
            <a href="{{ route('proyek.create') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold text-sm shadow-lg shadow-indigo-500/20 transition-all duration-200 transform active:scale-95">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Catat Proyek Baru</span>
            </a>
        </div>
    </div>
    <!-- Decorative glow background -->
    <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-indigo-500/10 blur-3xl"></div>
    <div class="absolute -left-16 -bottom-16 h-48 w-48 rounded-full bg-pink-500/10 blur-3xl"></div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat 1: Total Proyek -->
    <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
        <div class="flex items-center justify-between mb-4">
            <span class="text-xs uppercase tracking-wider font-bold text-indigo-400">Total Proyek</span>
            <div class="h-10 w-10 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center border border-indigo-500/20 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                <i class="fa-solid fa-diagram-project text-base"></i>
            </div>
        </div>
        <div class="flex items-baseline gap-2">
            <span class="font-outfit text-4xl font-extrabold text-white">{{ $totalProyek }}</span>
            <span class="text-xs text-slate-400">proyek</span>
        </div>
        <div class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 opacity-50"></div>
    </div>

    <!-- Stat 2: Perencanaan -->
    <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
        <div class="flex items-center justify-between mb-4">
            <span class="text-xs uppercase tracking-wider font-bold text-amber-400">Perencanaan</span>
            <div class="h-10 w-10 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center border border-amber-500/20 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                <i class="fa-solid fa-map text-base"></i>
            </div>
        </div>
        <div class="flex items-baseline gap-2">
            <span class="font-outfit text-4xl font-extrabold text-white">{{ $totalPerencanaan }}</span>
            <span class="text-xs text-slate-400">proyek</span>
        </div>
        <div class="absolute inset-x-0 bottom-0 h-1 bg-amber-500 opacity-50"></div>
    </div>

    <!-- Stat 3: Proses atau Revisi -->
    <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
        <div class="flex items-center justify-between mb-4">
            <span class="text-xs uppercase tracking-wider font-bold text-sky-400">Proses / Revisi</span>
            <div class="h-10 w-10 rounded-xl bg-sky-500/10 text-sky-400 flex items-center justify-center border border-sky-500/20 group-hover:bg-sky-500 group-hover:text-white transition-all duration-300">
                <i class="fa-solid fa-arrows-spin text-base"></i>
            </div>
        </div>
        <div class="flex items-baseline gap-2">
            <span class="font-outfit text-4xl font-extrabold text-white">{{ $totalProsesRevisi }}</span>
            <span class="text-xs text-slate-400">proyek</span>
        </div>
        <div class="absolute inset-x-0 bottom-0 h-1 bg-sky-500 opacity-50"></div>
    </div>

    <!-- Stat 4: Selesai -->
    <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
        <div class="flex items-center justify-between mb-4">
            <span class="text-xs uppercase tracking-wider font-bold text-emerald-400">Selesai</span>
            <div class="h-10 w-10 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center border border-emerald-500/20 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                <i class="fa-solid fa-circle-check text-base"></i>
            </div>
        </div>
        <div class="flex items-baseline gap-2">
            <span class="font-outfit text-4xl font-extrabold text-white">{{ $totalSelesai }}</span>
            <span class="text-xs text-slate-400">proyek</span>
        </div>
        <div class="absolute inset-x-0 bottom-0 h-1 bg-emerald-500 opacity-50"></div>
    </div>
</div>

<!-- Recent Projects & Actions -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- 5 Newest Projects -->
    <div class="lg:col-span-3 glass-panel rounded-2xl p-6 border border-slate-800">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-outfit text-lg font-bold text-white">5 Proyek Terbaru</h3>
                <p class="text-xs text-slate-400">Catatan proyek yang baru-baru ini Anda tambahkan</p>
            </div>
            <a href="{{ route('proyek.index') }}" class="text-xs font-semibold text-indigo-400 hover:text-indigo-300 transition-colors flex items-center gap-1">
                <span>Lihat Semua</span>
                <i class="fa-solid fa-angle-right text-[10px]"></i>
            </a>
        </div>

        @if ($proyekTerbaru->isEmpty())
            <div class="py-12 flex flex-col items-center justify-center text-center">
                <div class="h-16 w-16 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-500 mb-4 shadow-inner">
                    <i class="fa-solid fa-folder-open text-2xl"></i>
                </div>
                <h4 class="text-sm font-semibold text-slate-300">Belum ada data proyek</h4>
                <p class="text-xs text-slate-500 mt-1 max-w-xs">Mulai catat proyek pertama Anda dengan menekan tombol 'Catat Proyek Baru'.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-800 text-xs font-bold text-slate-400 uppercase">
                            <th class="py-4 px-3">Nama Proyek</th>
                            <th class="py-4 px-3">Kategori</th>
                            <th class="py-4 px-3">Teknologi</th>
                            <th class="py-4 px-3">Status</th>
                            <th class="py-4 px-3">Tanggal Mulai</th>
                            <th class="py-4 px-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/50 text-sm">
                        @foreach ($proyekTerbaru as $proyek)
                            <tr class="hover:bg-slate-900/30 transition-colors">
                                <td class="py-4 px-3">
                                    <div class="font-semibold text-slate-200">{{ $proyek->nama_proyek }}</div>
                                    <div class="text-xs text-slate-500 max-w-xs truncate">{{ $proyek->deskripsi ?? 'Tanpa deskripsi' }}</div>
                                </td>
                                <td class="py-4 px-3 text-slate-300">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-slate-900 border border-slate-800 text-slate-400">
                                        <i class="fa-solid @if(strtolower($proyek->jenis_proyek)=='web') fa-globe @elseif(strtolower($proyek->jenis_proyek)=='mobile') fa-mobile-screen-button @elseif(strtolower($proyek->jenis_proyek)=='desktop') fa-desktop @elseif(strtolower($proyek->jenis_proyek)=='ui design' || strtolower($proyek->jenis_proyek)=='ui/ux') fa-palette @else fa-cube @endif text-[10px]"></i>
                                        {{ $proyek->jenis_proyek }}
                                    </span>
                                </td>
                                <td class="py-4 px-3 text-slate-300 font-mono text-xs">{{ $proyek->teknologi }}</td>
                                <td class="py-4 px-3">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold 
                                        @if($proyek->status_proyek == 'Perencanaan') badge-perencanaan
                                        @elseif($proyek->status_proyek == 'Proses') badge-proses
                                        @elseif($proyek->status_proyek == 'Revisi') badge-revisi
                                        @elseif($proyek->status_proyek == 'Selesai') badge-selesai
                                        @endif">
                                        {{ $proyek->status_proyek }}
                                    </span>
                                </td>
                                <td class="py-4 px-3 text-slate-400 text-xs">
                                    {{ \Carbon\Carbon::parse($proyek->tanggal_mulai)->translatedFormat('d M Y') }}
                                </td>
                                <td class="py-4 px-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('proyek.edit', $proyek->id) }}" class="p-2 rounded-lg bg-indigo-500/10 hover:bg-indigo-500/20 text-indigo-400 border border-indigo-500/20 transition-all" title="Edit Proyek">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button type="button" 
                                            onclick="openDeleteModal('{{ route('proyek.destroy', $proyek->id) }}', '{{ $proyek->nama_proyek }}')" 
                                            class="p-2 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/20 transition-all" 
                                            title="Hapus Proyek">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- Elegant Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
    
    <!-- Modal Content -->
    <div class="glass-panel max-w-md w-full mx-4 p-6 rounded-2xl shadow-2xl relative z-10 animate-fade-in border border-rose-500/20">
        <div class="flex items-center gap-4 text-rose-400 mb-4">
            <div class="h-12 w-12 rounded-full bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-xl">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div>
                <h3 class="font-outfit text-lg font-bold text-white">Konfirmasi Hapus</h3>
                <p class="text-xs text-slate-400">Tindakan ini tidak dapat dibatalkan</p>
            </div>
        </div>
        <p class="text-sm text-slate-300 mb-6">
            Apakah Anda yakin ingin menghapus proyek <span id="deleteProjectName" class="font-semibold text-rose-400"></span>? Semua data terkait proyek ini akan dihapus secara permanen.
        </p>
        <div class="flex justify-end gap-3">
            <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 rounded-xl border border-slate-700 bg-slate-800/40 text-slate-300 hover:bg-slate-800 text-sm font-semibold transition-all">
                Batal
            </button>
            <form id="deleteForm" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold shadow-lg shadow-rose-600/20 transition-all">
                    Hapus Permanen
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openDeleteModal(url, name) {
        document.getElementById('deleteForm').action = url;
        document.getElementById('deleteProjectName').innerText = name;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
@endsection
