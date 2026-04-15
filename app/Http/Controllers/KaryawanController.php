<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    // READ
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'nama'); // Default sort by name
        $order = $request->input('order', 'asc');

        // Eloquent Join using 'with' for Eager Loading
        $karyawan = Karyawan::with(['gajis', 'departemen'])
            ->when($search, function($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                             ->orWhere('posisi', 'like', "%{$search}%");
            })
            ->orderBy($sort, $order)
            ->paginate(10);

        return view('karyawan.index', compact('karyawan', 'search', 'sort', 'order'));
    }

    public function show()
    {
        return view('karyawan.tambah');
    }

    // CREATE
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'posisi' => 'required'
        ]);
    
        Karyawan::create([
            'nama' => $validatedData['nama'],
            'posisi' => $validatedData['posisi']
        ]);

        return redirect('/karyawan');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);

        return view('karyawan.edit', ['karyawan' => $karyawan]);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'posisi' => 'required'
        ]);
        
        $karyawan->update([
            'nama' => $request->nama,
            'posisi' => $request->posisi
        ]);

        return redirect('/karyawan');
    }

    // DELETE
    public function destroy($id)
    {
        Karyawan::destroy($id);

        return redirect('/karyawan');
    }
}
