<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-950 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Catatan Proyek Siswa RPL') - Proyek Siswa</title>
    
    <!-- Google Fonts: Outfit & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Outfit', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        dark: {
                            950: '#030712',
                            900: '#0b0f19',
                            800: '#111827',
                            700: '#1f2937',
                        },
                        brand: {
                            glow: '#6366f1',
                            pink: '#ec4899',
                            cyan: '#06b6d4',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Modern Mesh Background & Scrollbar */
        body {
            background-color: #030712;
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(236, 72, 153, 0.15) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(6, 182, 212, 0.1) 0px, transparent 50%);
            background-attachment: fixed;
        }

        /* Glassmorphism utility */
        .glass-panel {
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .glass-card {
            background: rgba(30, 41, 59, 0.3);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            transform: translateY(-4px);
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: 0 10px 30px -10px rgba(99, 102, 241, 0.2);
            background: rgba(30, 41, 59, 0.45);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.5);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(99, 102, 241, 0.3);
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(99, 102, 241, 0.5);
        }

        /* Status Badge Glow Effects */
        .badge-perencanaan {
            background: rgba(234, 179, 8, 0.15);
            color: #f59e0b;
            border: 1px solid rgba(234, 179, 8, 0.3);
            box-shadow: 0 0 10px rgba(234, 179, 8, 0.1);
        }
        .badge-proses {
            background: rgba(59, 130, 246, 0.15);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.3);
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.1);
        }
        .badge-revisi {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.1);
        }
        .badge-selesai {
            background: rgba(34, 197, 94, 0.15);
            color: #22c55e;
            border: 1px solid rgba(34, 197, 94, 0.3);
            box-shadow: 0 0 10px rgba(34, 197, 94, 0.1);
        }
    </style>
    @yield('styles')
</head>
<body class="flex flex-col min-h-screen font-sans">

    <!-- Navbar / Sidebar Wrapper -->
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar Navigation -->
        <aside class="w-full md:w-64 glass-panel border-r border-slate-800 flex flex-col z-20">
            <!-- Brand Section -->
            <div class="p-6 border-b border-slate-800 flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-500 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        <i class="fa-solid fa-graduation-cap text-lg text-white"></i>
                    </div>
                    <div>
                        <h1 class="font-outfit font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-slate-400 tracking-tight text-sm">PROYEK RPL</h1>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-indigo-400">Student Portal</span>
                    </div>
                </a>
            </div>

            <!-- Student Profile Summary -->
            <div class="p-5 border-b border-slate-800/60 bg-slate-900/20">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-pink-500 flex items-center justify-center font-bold text-white shadow-inner">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div class="overflow-hidden">
                        <h2 class="text-sm font-semibold truncate text-slate-200">{{ Auth::user()->name }}</h2>
                        <span class="text-xs text-slate-400 flex items-center gap-1">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Siswa RPL
                        </span>
                    </div>
                </div>
            </div>

            <!-- Menu Items -->
            <nav class="flex-1 p-4 space-y-1.5">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-600/20 text-indigo-400 border border-indigo-500/30' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200 border border-transparent' }}">
                    <i class="fa-solid fa-chart-line text-lg"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('proyek.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('proyek.*') ? 'bg-indigo-600/20 text-indigo-400 border border-indigo-500/30' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200 border border-transparent' }}">
                    <i class="fa-solid fa-diagram-project text-lg"></i>
                    <span>Catatan Proyek</span>
                </a>
                <a href="{{ route('laporan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('laporan.index') ? 'bg-indigo-600/20 text-indigo-400 border border-indigo-500/30' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200 border border-transparent' }}">
                    <i class="fa-solid fa-file-invoice text-lg"></i>
                    <span>Laporan Proyek</span>
                </a>
            </nav>

            <!-- Footer / Logout Section -->
            <div class="p-4 border-t border-slate-800 mt-auto">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium text-rose-400 hover:bg-rose-500/10 border border-transparent hover:border-rose-500/20 transition-all duration-200">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Header Bar -->
            <header class="h-16 glass-panel border-b border-slate-800/60 px-6 flex items-center justify-between z-10">
                <div class="flex items-center gap-4">
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-slate-800 border border-slate-700 text-slate-300">
                        LKS Web Tech
                    </span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-xs text-slate-400 font-medium">
                        {{ Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </span>
                </div>
            </header>

            <!-- Inner Page Content -->
            <div class="flex-1 p-6 md:p-8 overflow-y-auto">
                <!-- Session Alerts -->
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center gap-3 animate-fade-in">
                        <i class="fa-solid fa-circle-check text-lg"></i>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-400 flex items-center gap-3 animate-fade-in">
                        <i class="fa-solid fa-circle-exclamation text-lg"></i>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @yield('scripts')
</body>
</html>
