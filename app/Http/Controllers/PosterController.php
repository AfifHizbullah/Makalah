<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PosterController extends Controller
{
    public function index()
    {
        $posters = Poster::all();
        return response()->json($posters);
    }

    public function create(Request $request)
    {
        // Menampilkan formulir untuk membuat poster baru
        return view('posters.create'); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Judul_Artikel' => 'required',
            'Penulis' => ['required', 'regex:/^[a-zA-Z\s]+$/'], // Validasi hanya huruf
            'Nama_Seminar' => 'required',
            'Penyelenggara_Seminar' => 'required',
            'Waktu_Pelaksaaan' => 'required|date_format:Y-m-d', // Validasi format tanggal YYYY-MM-DD
            'ISBN_ISSN' => 'required',
            'URL' => 'required|url'
        ], [
            'Waktu_Pelaksaaan.date_format' => 'Format tanggal harus YYYY-MM-DD.',
            'Penulis.regex' => 'Nama penulis harus berupa huruf dan tidak boleh angka atau karakter khusus.'
        ]);
    
        // Membuat entri baru dalam database
        Poster::create($validatedData);
    
        return redirect()->route('posters.index')->with('success', 'Poster added successfully');
    }

    public function show()
    {
        $posters = Poster::all();
        return view('posters.show', compact('posters'));
    }

    public function edit($id)
    {
        $posters = Poster::findOrFail($id);
        return view('posters.edit', compact('posters'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Judul_Artikel' => 'required',
            'Penulis' => ['required', 'regex:/^[a-zA-Z\s]+$/'], // Validasi hanya huruf
            'Nama_Seminar' => 'required',
            'Penyelenggara_Seminar' => 'required',
            'Waktu_Pelaksaaan' => 'required|date_format:Y-m-d', // Validasi format tanggal YYYY-MM-DD
            'ISBN_ISSN' => 'required',
            'URL' => 'required|url'
        ], [
            'Waktu_Pelaksaaan.date_format' => 'Format tanggal harus YYYY-MM-DD.',
            'Penulis.regex' => 'Nama penulis harus berupa huruf dan tidak boleh angka atau karakter khusus.'
        ]);

        $posters = Poster::findOrFail($id);
        $posters->update($validatedData);
        
        return redirect()->route('posters.show', $posters->id)->with('success', 'Poster updated successfully');
    }

    public function destroy($id)
    {
        $posters = Poster::findOrFail($id);
        $posters->delete();
        return redirect()->route('posters.index')->with('success', 'Poster deleted successfully');
    }
}
