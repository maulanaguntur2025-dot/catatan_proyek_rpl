@extends('layouts.app')

@section('title', 'Daftar Proyek')

@section('content')
<div class="glass-panel rounded-3xl p-6 md:p-8 border border-slate-800">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="font-outfit text-2xl md:text-3xl font-extrabold text-white">Catatan Proyek Anda</h1>
            <p class="text-sm text-slate-400 mt-1">Daftar lengkap seluruh proyek yang sedang Anda kelola</p>
        </div>
        <div>
            <a href="{{ route('proyek.create') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold text-sm shadow-lg shadow-indigo-500/20 transition-all duration-200 transform active:scale-95">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Tambah Proyek</span>
            </a>
        </div>
    </div>

    @if ($proyeks->isEmpty())
        <div class="py-20 flex flex-col items-center justify-center text-center">
            <div class="h-20 w-20 rounded-2xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-500 mb-6 shadow-inner">
                <i class="fa-solid fa-diagram-project text-3xl text-indigo-500/50"></i>
            </div>
            <h3 class="text-lg font-bold text-white">Belum ada proyek terdaftar</h3>
            <p class="text-sm text-slate-400 mt-2 max-w-sm">Anda belum menambahkan catatan proyek. Mulai catat proyek pertama Anda sekarang!</p>
            <a href="{{ route('proyek.create') }}" class="mt-6 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-700 bg-indigo-600/10 text-indigo-400 hover:bg-indigo-600/20 text-sm font-semibold transition-all">
                <span>Catat Proyek Pertama</span>
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-800 text-xs font-bold text-slate-400 uppercase">
                        <th class="py-4 px-4">Nama Proyek</th>
                        <th class="py-4 px-4">Kategori</th>
                        <th class="py-4 px-4">Teknologi</th>
                        <th class="py-4 px-4">Status</th>
                        <th class="py-4 px-4">Masa Pengerjaan</th>
                        <th class="py-4 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/50 text-sm">
                    @foreach ($proyeks as $proyek)
                        <tr class="hover:bg-slate-900/20 transition-colors">
                            <td class="py-4 px-4">
                                <div class="font-semibold text-slate-200 text-base">{{ $proyek->nama_proyek }}</div>
                                <div class="text-xs text-slate-500 max-w-md mt-0.5 line-clamp-2 leading-relaxed">
                                    {{ $proyek->deskripsi ?? 'Tidak ada deskripsi proyek.' }}
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-slate-900 border border-slate-800 text-slate-300">
                                    <i class="fa-solid @if(strtolower($proyek->jenis_proyek)=='web') fa-globe @elseif(strtolower($proyek->jenis_proyek)=='mobile') fa-mobile-screen-button @elseif(strtolower($proyek->jenis_proyek)=='desktop') fa-desktop @elseif(strtolower($proyek->jenis_proyek)=='ui design' || strtolower($proyek->jenis_proyek)=='ui/ux') fa-palette @else fa-cube @endif text-[10px] text-indigo-400"></i>
                                    {{ $proyek->jenis_proyek }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="font-mono text-xs text-indigo-300 bg-indigo-500/5 px-2 py-1 rounded border border-indigo-500/10">
                                    {{ $proyek->teknologi }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold 
                                    @if($proyek->status_proyek == 'Perencanaan') badge-perencanaan
                                    @elseif($proyek->status_proyek == 'Proses') badge-proses
                                    @elseif($proyek->status_proyek == 'Revisi') badge-revisi
                                    @elseif($proyek->status_proyek == 'Selesai') badge-selesai
                                    @endif">
                                    {{ $proyek->status_proyek }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-xs text-slate-300">
                                    <span class="text-slate-400">Mulai:</span> {{ \Carbon\Carbon::parse($proyek->tanggal_mulai)->translatedFormat('d M Y') }}
                                </div>
                                <div class="text-xs text-slate-300 mt-0.5">
                                    <span class="text-slate-400">Selesai:</span> 
                                    @if ($proyek->tanggal_selesai)
                                        {{ \Carbon\Carbon::parse($proyek->tanggal_selesai)->translatedFormat('d M Y') }}
                                    @else
                                        <span class="text-sky-400 italic">Sedang Berjalan</span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-4 text-right">
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
