<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        $breakingNews = News::latest()->take(1)->get();
        $newsList = News::latest()->take(8)->get();
        $sideNews = News::latest()->take(3)->get();
        return view('index', compact('breakingNews', 'newsList', 'sideNews'));
    }
    public function politics()
    {
        $news = News::where('category', 'politics')->latest()->get();
        return view('politics', compact('news'));
    }
    public function business()
    {
        $news = News::where('category', 'business')->latest()->get();
        return view('business', compact('news'));    
    }    
    public function sports()
    {
        $news = News::where('category', 'sports')->latest()->get();
        return view('sports', compact('news'));    
    }
    public function technology()
    {
        $news = News::where('category', 'technology')->latest()->get();
        return view('technology', compact('news'));
    }    
    public function entertainment()
    {
        $news = News::where('category', 'entertainment')->latest()->get();
        return view('entertainment', compact('news'));
    }
}
