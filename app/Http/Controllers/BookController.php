<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Book::with('category')->latest();

        // Fitur Pencarian berdasarkan Judul Buku atau Penulis
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Fitur Filter berdasarkan Kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Fitur Pagination (10 data per halaman)
        $books = $query->paginate(10)->withQueryString();

        return view('books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock'       => 'required|integer|min:0',
            'author'      => 'nullable|string|max:255',
            'year'        => 'nullable|integer',
            'cover'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Simpan file gambar jika ada yang diunggah
        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        Book::create([
            'title'       => $request->title,
            'category_id' => $request->category_id,
            'stock'       => $request->stock,
            'author'      => $request->author ?? '-',
            'year'        => $request->year ?? date('Y'),
            'cover'       => $coverPath,
        ]);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock'       => 'required|integer|min:0',
            'author'      => 'nullable|string|max:255',
            'year'        => 'nullable|integer',
            'cover'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Pertahankan cover lama secara default
        $coverPath = $book->cover;

        // Jika ada file cover baru yang diunggah, hapus yang lama lalu simpan yang baru
        if ($request->hasFile('cover')) {
            if ($book->cover && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        $book->update([
            'title'       => $request->title,
            'category_id' => $request->category_id,
            'stock'       => $request->stock,
            'author'      => $request->author ?? '-',
            'year'        => $request->year ?? date('Y'),
            'cover'       => $coverPath,
        ]);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Book $book)
    {
        // Hapus file cover dari storage sebelum menghapus data buku
        if ($book->cover && Storage::disk('public')->exists($book->cover)) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}