<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\News;

class AdminController extends Controller
{
        public function index()
        {
            // Get statistics
            $totalNews = News::count();
            $publishedNews = News::count(); // All news are considered published
            $draftNews = 0; // No draft status in current schema
            
            // Get category statistics
            $categoryData = News::select('category', DB::raw('count(*) as count'))
                ->groupBy('category')
                ->get();
            
            $categories = $categoryData->pluck('category')->toArray();
            $newsCounts = $categoryData->pluck('count')->toArray();
            $totalCategories = count($categories);
            
            return view('Dashboard.index', compact(
                'totalNews',
                'publishedNews', 
                'draftNews',
                'totalCategories',
                'categories',
                'newsCounts'
            ));
        }
        public function addNews()
        {
            return view('Dashboard.addNews');
        }
        public function store(Request $request)
        {
            // Validate the request
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|string',
                'content' => 'required|string',
                'url' => 'nullable|url',
                'image' => 'nullable|image|max:2048', // max 2MB
            ]);

            // Handle image upload if present
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('news_images', 'public');
            }

            // Create the news article
            News::create([
                'title' => $validated['title'],
                'category' => $validated['category'],
                'content' => $validated['content'],
                'author' => Auth::user()?->name ?? 'Admin', // Use authenticated user or default to 'Admin'
                'image' => $imagePath,
                'url' => $validated['url'] ?? null,
                'published_at' => now(),
            ]);

            return redirect()->route('admin.newsView')->with('success', 'News added successfully!');
        }
        public function newsView()
        {  
             // Fetch all news articles from the database
            $newsList = News::all();
            return view('Dashboard.newsView', compact('newsList'));
        }
        public function deleteNews($id)
        {
            $news = News::findOrFail($id);
            $news->delete();

            return redirect()->route('admin.newsView')->with('success', 'News deleted successfully!');
        }
        public function editNews($id)
        {
            $news = News::findOrFail($id);
            return view('Dashboard.editNews', compact('news'));
        }
        public function updateNews(Request $request, $id)
        {
            $news = News::findOrFail($id);  
            // Validate the request
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|string',
                'content' => 'required|string',
                'url' => 'nullable|url',
                'image' => 'nullable|image|max:2048', // max 2MB
            ]);

            // Handle image upload if present
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('news_images', 'public');
                $news->image = $imagePath;
            }
            $news->update($validated);
            return redirect()->route('admin.newsView')->with('success', 'News updated successfully!');
        }
}
