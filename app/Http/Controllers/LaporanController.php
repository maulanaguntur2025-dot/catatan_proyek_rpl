<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $proyeks = $user->proyek()->orderBy('id', 'desc')->get();
        $tanggalCetak = Carbon::now()->translatedFormat('d F Y H:i');

        return view('laporan.index', compact('user', 'proyeks', 'tanggalCetak'));
    }
}
