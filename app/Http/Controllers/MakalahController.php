<?php

namespace App\Http\Controllers;

use App\Models\Makalah;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MakalahController extends Controller
{
    public function index()
    {
        $makalahs = Makalah::all();
        return response()->json($makalahs);
    }

    public function create(Request $request)
    {
        return view('makalahs.create'); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Judul_Artikel' => 'required',
            'Penulis' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'Nama_Seminar' => 'required',
            'Penyelenggara_Seminar' => 'required',
            'Waktu_Pelaksaaan' => 'required|date_format:Y-m-d',
            'URL' => 'required|url'
        ], [
            'Waktu_Pelaksaaan.date_format' => 'Format tanggal harus YYYY-MM-DD.',
            'Penulis.regex' => 'Nama penulis harus berupa huruf dan tidak boleh angka atau karakter khusus.'
        ]);
    
        // Membuat entri baru dalam database
        Makalah::create($validatedData);
    
        return redirect()->route('makalahs.index')->with('success', 'Makalah added successfully');
    }
    
    public function show()
    {
        $makalahs= Makalah::all();
        return view('makalahs.show', compact('makalahs'));
    }

    public function edit($id)
    {
        $makalahs = Makalah::findOrFail($id);
        return view('makalahs.edit', compact('makalahs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Judul_Artikel' => 'required',
            'Penulis' => ['required', 'regex:/^[a-zA-Z\s]+$/'], // Validasi hanya huruf
            'Nama_Seminar' => 'required',
            'Penyelenggara_Seminar' => 'required',
            'Waktu_Pelaksaaan' => 'required|date_format:Y-m-d', // Pastikan format tanggal YYYY-MM-DD
            'URL' => 'required|url' // Validasi URL
        ], [
            'Waktu_Pelaksaaan.date_format' => 'Format tanggal harus YYYY-MM-DD.',
            'Penulis.regex' => 'Nama penulis harus berupa huruf dan tidak boleh angka atau karakter khusus.'
        ]);

        $makalahs = Makalah::findOrFail($id);
        $makalahs->update($request->all());
        
        return redirect()->route('makalahs.show', $makalahs->id)->with('success', 'Makalah updated successfully');
    }

    public function destroy($id)
    {
        $makalahs = Makalah::findOrFail($id);
        $makalahs->delete();
        return redirect()->route('makalahs.index')->with('success', 'Makalah deleted successfully');
    }
}
