@extends('layouts.app')

@section('title', 'Laporan Proyek')

@section('styles')
<style>
    /* Styling for print mode */
    @media print {
        /* Hide navbar, sidebar, print buttons and header */
        aside, header, #print-action-bar, .breadcrumb-nav {
            display: none !important;
        }
        
        /* Reset margins and backgrounds for print */
        body {
            background: white !important;
            color: #111827 !important;
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        
        main {
            padding: 0 !important;
            margin: 0 !important;
        }

        .glass-panel {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            backdrop-filter: none !important;
            padding: 0 !important;
        }

        /* Table styling for paper print */
        table {
            border-collapse: collapse !important;
            width: 100% !important;
            margin-top: 20px !important;
        }

        th, td {
            border: 1px solid #d1d5db !important;
            padding: 8px 12px !important;
            color: #111827 !important;
            background: transparent !important;
        }

        th {
            background-color: #f3f4f6 !important;
            font-weight: bold !important;
        }

        /* Text colors for readability */
        h1, h2, h3, h4, p, span, td, th {
            color: #111827 !important;
        }

        .badge-perencanaan, .badge-proses, .badge-revisi, .badge-selesai {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            color: #111827 !important;
            font-weight: 600 !important;
        }
    }
</style>
@endsection

@section('content')
<!-- Actions Bar -->
<div id="print-action-bar" class="glass-panel rounded-3xl p-6 border border-slate-800 mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="font-outfit text-xl font-bold text-white">Cetak Laporan Proyek</h1>
        <p class="text-xs text-slate-400 mt-1">Ekspor catatan proyek Anda ke format PDF atau cetak secara fisik.</p>
    </div>
    <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold text-sm shadow-lg shadow-indigo-500/20 transition-all duration-200 transform active:scale-95">
        <i class="fa-solid fa-print"></i>
        <span>Cetak Sekarang (Ctrl + P)</span>
    </button>
</div>

<!-- Report Document Area -->
<div class="glass-panel rounded-3xl p-6 md:p-10 border border-slate-800 bg-slate-900/10 shadow-2xl relative">
    
    <!-- Report Document Header (visible on screen and print) -->
    <div class="border-b border-slate-800 pb-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
            <div>
                <h2 class="font-outfit text-2xl font-extrabold text-white tracking-tight uppercase">Laporan Catatan Proyek Siswa</h2>
                <p class="text-sm text-indigo-400 font-semibold tracking-wider uppercase mt-1">Kompetensi Keahlian Rekayasa Perangkat Lunak</p>
            </div>
            <div class="text-left md:text-right text-xs text-slate-400 space-y-1">
                <div><span class="font-semibold text-slate-300">Tanggal Cetak:</span> {{ $tanggalCetak }}</div>
                <div><span class="font-semibold text-slate-300">Dicetak Oleh:</span> {{ $user->name }}</div>
                <div><span class="font-semibold text-slate-300">Email:</span> {{ $user->email }}</div>
            </div>
        </div>
    </div>

    <!-- Student Metadata Summary Table (print-friendly) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm">
        <div class="space-y-2">
            <div class="flex gap-4">
                <span class="w-32 text-slate-400">Nama Siswa:</span>
                <span class="font-semibold text-white print:text-black">{{ $user->name }}</span>
            </div>
            <div class="flex gap-4">
                <span class="w-32 text-slate-400">Program Keahlian:</span>
                <span class="text-slate-300 print:text-black">Rekayasa Perangkat Lunak (RPL)</span>
            </div>
        </div>
        <div class="space-y-2">
            <div class="flex gap-4">
                <span class="w-32 text-slate-400">Total Proyek:</span>
                <span class="font-semibold text-indigo-400 print:text-black">{{ $proyeks->count() }} proyek</span>
            </div>
            <div class="flex gap-4">
                <span class="w-32 text-slate-400">Status Laporan:</span>
                <span class="text-emerald-400 font-semibold print:text-black flex items-center gap-1.5">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Valid / Terverifikasi
                </span>
            </div>
        </div>
    </div>

    @if ($proyeks->isEmpty())
        <div class="py-12 text-center text-slate-500 border border-dashed border-slate-800 rounded-2xl">
            <i class="fa-solid fa-circle-exclamation text-2xl mb-2 text-indigo-500/50"></i>
            <p class="text-sm font-semibold">Tidak ada catatan proyek untuk dicetak.</p>
        </div>
    @else
        <!-- Project Data Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse mt-4">
                <thead>
                    <tr class="border-b border-slate-800 bg-slate-900/30 print:bg-slate-100 text-xs font-bold text-slate-400 print:text-black uppercase">
                        <th class="py-3 px-4 text-center w-12">No</th>
                        <th class="py-3 px-4">Nama Proyek</th>
                        <th class="py-3 px-4">Kategori</th>
                        <th class="py-3 px-4">Teknologi</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Tanggal Mulai</th>
                        <th class="py-3 px-4">Tanggal Selesai</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/50 print:divide-y-0 text-sm">
                    @foreach ($proyeks as $index => $proyek)
                        <tr class="hover:bg-slate-900/10 transition-colors">
                            <td class="py-3 px-4 text-center font-semibold text-slate-400 print:text-black">
                                {{ $index + 1 }}
                            </td>
                            <td class="py-3 px-4">
                                <div class="font-bold text-slate-200 print:text-black">{{ $proyek->nama_proyek }}</div>
                                <div class="text-xs text-slate-500 print:text-slate-600 mt-1">{{ $proyek->deskripsi ?? 'Tanpa deskripsi' }}</div>
                            </td>
                            <td class="py-3 px-4 text-slate-300 print:text-black">
                                {{ $proyek->jenis_proyek }}
                            </td>
                            <td class="py-3 px-4 text-slate-300 print:text-black font-mono text-xs">
                                {{ $proyek->teknologi }}
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded text-xs font-bold 
                                    @if($proyek->status_proyek == 'Perencanaan') badge-perencanaan
                                    @elseif($proyek->status_proyek == 'Proses') badge-proses
                                    @elseif($proyek->status_proyek == 'Revisi') badge-revisi
                                    @elseif($proyek->status_proyek == 'Selesai') badge-selesai
                                    @endif">
                                    {{ $proyek->status_proyek }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-400 print:text-black text-xs">
                                {{ \Carbon\Carbon::parse($proyek->tanggal_mulai)->translatedFormat('d M Y') }}
                            </td>
                            <td class="py-3 px-4 text-slate-400 print:text-black text-xs">
                                {{ $proyek->tanggal_selesai ? \Carbon\Carbon::parse($proyek->tanggal_selesai)->translatedFormat('d M Y') : 'Sedang Berjalan' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Document Footer Signatures (Only visible on print) -->
    <div class="hidden print:block mt-16">
        <div class="flex justify-between text-sm">
            <div>
                <p>Mengetahui,</p>
                <p class="font-bold mt-16">Guru Pembimbing RPL</p>
                <p class="text-xs text-slate-500">( ________________________ )</p>
            </div>
            <div class="text-right">
                <p>Subang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p class="font-bold mt-16">Siswa / Peserta Didik</p>
                <p class="text-xs text-slate-500 font-bold underline">{{ $user->name }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
