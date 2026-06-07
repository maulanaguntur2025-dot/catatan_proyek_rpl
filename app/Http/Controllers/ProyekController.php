<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use Illuminate\Support\Facades\Auth;

class ProyekController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        $proyeks = Auth::user()->proyek()->orderBy('id', 'desc')->get();
        return view('proyek.index', compact('proyeks'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('proyek.create');
    }

    /**
     * Store a newly created project in database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:100',
            'jenis_proyek' => 'required|string|max:100',
            'teknologi' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'status_proyek' => 'required|in:Perencanaan,Proses,Revisi,Selesai',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ], [
            'nama_proyek.required' => 'Nama proyek wajib diisi.',
            'nama_proyek.max' => 'Nama proyek maksimal 100 karakter.',
            'jenis_proyek.required' => 'Jenis proyek wajib diisi.',
            'teknologi.required' => 'Teknologi wajib diisi.',
            'status_proyek.required' => 'Status proyek wajib diisi.',
            'status_proyek.in' => 'Status proyek tidak valid.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
        ]);

        Auth::user()->proyek()->create($request->all());

        return redirect()->route('proyek.index')->with('success', 'Catatan proyek berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit($id)
    {
        // Find project belonging to the logged-in user
        $proyek = Proyek::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$proyek) {
            return redirect()->route('proyek.index')->with('error', 'Data tidak ditemukan atau Anda tidak memiliki akses.');
        }

        return view('proyek.edit', compact('proyek'));
    }

    /**
     * Update the specified project in database.
     */
    public function update(Request $request, $id)
    {
        $proyek = Proyek::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$proyek) {
            return redirect()->route('proyek.index')->with('error', 'Data tidak ditemukan atau Anda tidak memiliki akses.');
        }

        $request->validate([
            'nama_proyek' => 'required|string|max:100',
            'jenis_proyek' => 'required|string|max:100',
            'teknologi' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'status_proyek' => 'required|in:Perencanaan,Proses,Revisi,Selesai',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ], [
            'nama_proyek.required' => 'Nama proyek wajib diisi.',
            'nama_proyek.max' => 'Nama proyek maksimal 100 karakter.',
            'jenis_proyek.required' => 'Jenis proyek wajib diisi.',
            'teknologi.required' => 'Teknologi wajib diisi.',
            'status_proyek.required' => 'Status proyek wajib diisi.',
            'status_proyek.in' => 'Status proyek tidak valid.',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
        ]);

        $proyek->update($request->all());

        return redirect()->route('proyek.index')->with('success', 'Catatan proyek berhasil diperbarui.');
    }

    /**
     * Remove the specified project from database.
     */
    public function destroy($id)
    {
        $proyek = Proyek::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$proyek) {
            return redirect()->route('proyek.index')->with('error', 'Data tidak ditemukan atau Anda tidak memiliki akses.');
        }

        $proyek->delete();

        return redirect()->route('proyek.index')->with('success', 'Catatan proyek berhasil dihapus.');
    }
}
