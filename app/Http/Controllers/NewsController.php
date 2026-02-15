<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
     public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'url' => 'nullable|string|max:500',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('news-images', $imageName, 'public');
            $validatedData['image_url'] = $imagePath;
        }

        // Remove 'image' key as it's not in the database
        unset($validatedData['image']);

        News::create($validatedData);

        return redirect()->route('admin.newsView')->with('success', 'News article added successfully.');
    }
    
}
