<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Download;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();
        $totalDownloads = Download::count();

        $recentBooks = Book::latest()->take(5)->get();

        $recentDownloads = Download::with([
            'user',
            'book'
        ])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalCategories',
            'totalUsers',
            'totalDownloads',
            'recentBooks',
            'recentDownloads'
        ));
    }
}