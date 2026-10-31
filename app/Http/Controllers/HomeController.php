<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::where('is_published', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::withCount([
            'books' => function ($query) {
                $query->where('is_published', true);
            }
        ])->orderBy('name')->get();

        return view('home', compact('books', 'categories'));
    }
}