<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        $breakingNews = News::where('is_approved', true)->latest()->take(1)->get();
        $newsList = News::where('is_approved', true)->latest()->take(8)->get();
        $sideNews = News::where('is_approved', true)->latest()->take(3)->get();
        return view('index', compact('breakingNews', 'newsList', 'sideNews'));
    }
    public function politics()
    {
        $news = News::where('category', 'politics')
            ->where('is_approved', true)
            ->latest()
            ->get();
        return view('politics', compact('news'));
    }
    public function business()
    {
        $news = News::where('category', 'business')
            ->where('is_approved', true)
            ->latest()
            ->get();
        return view('business', compact('news'));    
    }    
    public function sports()
    {
        $news = News::where('category', 'sports')
            ->where('is_approved', true)
            ->latest()
            ->get();
        return view('sports', compact('news'));    
    }
    public function technology()
    {
        $news = News::where('category', 'technology')
            ->where('is_approved', true)
            ->latest()
            ->get();
        return view('technology', compact('news'));
    }    
    public function entertainment()
    {
        $news = News::where('category', 'entertainment')
            ->where('is_approved', true)
            ->latest()
            ->get();
        return view('entertainment', compact('news'));
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $news = News::where('is_approved', true)
            ->where(function ($builder) use ($query) {
                $builder->where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->orWhere('author', 'LIKE', "%{$query}%")
                ;
            })
            ->latest()
            ->get();
        
        return view('search', compact('news', 'query'));
    }
}
