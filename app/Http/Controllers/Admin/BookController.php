<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')
            ->latest()
            ->paginate(15);

        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'isbn' => 'nullable|string|max:255|unique:books,isbn',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'pdf' => 'required|mimes:pdf|max:51200',
        ]);

        $coverPath = null;

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')
                ->store('covers', 'public');
        }

        $pdfPath = $request->file('pdf')
            ->store('books', 'local');

        Book::create([
            'category_id' => $data['category_id'] ?? null,
            'title' => $data['title'],
            'slug' => Str::slug($data['title']) . '-' . Str::lower(Str::random(8)),
            'author' => $data['author'],
            'isbn' => $data['isbn'] ?? null,
            'description' => $data['description'] ?? null,
            'cover_path' => $coverPath,
            'pdf_path' => $pdfPath,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.books.index')
            ->with('success', 'Book added successfully.');
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'isbn' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('books', 'isbn')->ignore($book->id),
            ],
            'description' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:51200',
        ]);

        if ($request->hasFile('cover')) {
            if ($book->cover_path) {
                Storage::disk('public')->delete($book->cover_path);
            }

            $data['cover_path'] = $request->file('cover')
                ->store('covers', 'public');
        }

        if ($request->hasFile('pdf')) {
            Storage::disk('local')->delete($book->pdf_path);

            $data['pdf_path'] = $request->file('pdf')
                ->store('books', 'local');
        }

        $book->fill([
            'category_id' => $data['category_id'] ?? null,
            'title' => $data['title'],
            'author' => $data['author'],
            'isbn' => $data['isbn'] ?? null,
            'description' => $data['description'] ?? null,
            'cover_path' => $data['cover_path'] ?? $book->cover_path,
            'pdf_path' => $data['pdf_path'] ?? $book->pdf_path,
            'is_published' => $request->boolean('is_published'),
        ]);

        $book->save();

        return redirect()->route('admin.books.index')
            ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        Storage::disk('local')->delete($book->pdf_path);

        if ($book->cover_path) {
            Storage::disk('public')->delete($book->cover_path);
        }

        $book->delete();

        return back()->with('success', 'Book deleted successfully.');
    }
}