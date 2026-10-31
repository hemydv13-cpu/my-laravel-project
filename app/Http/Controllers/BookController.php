<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Download;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category')
            ->where('is_published', true);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $books = $query->latest()->paginate(12)->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('books.index', compact('books', 'categories'));
    }

    public function show(Book $book)
    {
        abort_unless($book->is_published, 404);

        $book->increment('views');

        $book->load('category');

        return view('books.show', compact('book'));
    }

    public function read(Book $book)
    {
        abort_unless($book->is_published, 404);

        abort_unless(
            Storage::disk('local')->exists($book->pdf_path),
            404
        );

        return view('books.reader', compact('book'));
    }

    public function pdf(Book $book)
    {
        abort_unless($book->is_published, 404);

        $path = Storage::disk('local')->path($book->pdf_path);

        abort_unless(is_file($path), 404);

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="book.pdf"',
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'private, no-store',
        ]);
    }

    public function download(Book $book)
    {
        abort_unless($book->is_published, 404);

        abort_unless(
            Storage::disk('local')->exists($book->pdf_path),
            404
        );

        Download::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
        ]);

        return Storage::disk('local')->download(
            $book->pdf_path,
            $book->slug . '.pdf'
        );
    }

    public function bookmark(Book $book)
    {
        abort_unless($book->is_published, 404);

        $bookmark = auth()->user()->bookmarks()
            ->where('book_id', $book->id);

        if ($bookmark->exists()) {
            $bookmark->delete();
            $message = 'Bookmark removed.';
        } else {
            auth()->user()->bookmarks()->create([
                'book_id' => $book->id,
            ]);

            $message = 'Book added to bookmarks.';
        }

        return back()->with('success', $message);
    }

    public function myBookmarks()
    {
        $books = auth()->user()->bookmarks()
            ->with('book.category')
            ->latest()
            ->paginate(12);

        return view('books.bookmarks', compact('books'));
    }
}