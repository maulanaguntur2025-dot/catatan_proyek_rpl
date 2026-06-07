<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Count metrics for current logged-in user
        $totalProyek = $user->proyek()->count();
        $totalPerencanaan = $user->proyek()->where('status_proyek', 'Perencanaan')->count();
        $totalProsesRevisi = $user->proyek()->whereIn('status_proyek', ['Proses', 'Revisi'])->count();
        $totalSelesai = $user->proyek()->where('status_proyek', 'Selesai')->count();

        // 5 newest projects
        $proyekTerbaru = $user->proyek()->latest()->take(5)->get();

        return view('dashboard', compact(
            'user',
            'totalProyek',
            'totalPerencanaan',
            'totalProsesRevisi',
            'totalSelesai',
            'proyekTerbaru'
        ));
    }
}
