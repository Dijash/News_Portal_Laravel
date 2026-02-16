<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\News;
use App\Models\User;

class AdminController extends Controller
{
        public function index()
        {
            // Get statistics
            $totalNews = News::count();
            $publishedNews = News::where('is_approved', true)->count();
            $draftNews = News::where('is_approved', false)->count();
            
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

            $isAdmin = Auth::user()?->is_admin === true;

            // Create the news article
            News::create([
                'title' => $validated['title'],
                'category' => $validated['category'],
                'content' => $validated['content'],
                'author' => Auth::user()?->name ?? 'Admin', // Use authenticated user or default to 'Admin'
                'image' => $imagePath,
                'url' => $validated['url'] ?? null,
                'published_at' => $isAdmin ? now() : null,
                'is_approved' => $isAdmin,
            ]);

            $message = $isAdmin
                ? 'News added successfully!'
                : 'News submitted and pending admin approval.';

            return redirect()->route('admin.newsView')->with('success', $message);
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
        public function approveNews($id)
        {
            $news = News::findOrFail($id);

            if ($news->is_approved) {
                return back()->with('success', 'News already approved.');
            }

            $news->is_approved = true;
            $news->published_at = now();
            $news->save();

            return back()->with('success', 'News approved and published.');
        }
        public function manageUsers()
        {
            // Fetch all users from the database with pagination
            $users = User::latest()->paginate(10);
            return view('Dashboard.manageUsers', compact('users'));
        }

        public function toggleUserStatus($id)
        {
            $user = User::findOrFail($id);

            if ($user->id === Auth::id()) {
                return redirect()->route('admin.manageUsers')->with('error', 'You cannot deactivate your own account.');
            }

            $user->is_active = !$user->is_active;
            $user->save();

            $message = $user->is_active ? 'User activated successfully!' : 'User deactivated successfully!';

            return redirect()->route('admin.manageUsers')->with('success', $message);
        }
        
        public function showUser($id)
        {
            $user = User::findOrFail($id);
            return view('Dashboard.showUser', compact('user'));
        }
        
        public function deleteUser($id)
        {
            $user = User::findOrFail($id);
            
            // Prevent deleting yourself
            if ($user->id === Auth::id()) {
                return redirect()->route('admin.manageUsers')->with('error', 'You cannot delete your own account!');
            }
            
            $user->delete();
            return redirect()->route('admin.manageUsers')->with('success', 'User deleted successfully!');
        }
        public function analytics()
        {
            $totalNews = News::count();
            $totalUsers = User::count();
            $publishedNews = News::where('is_approved', true)->count();
            $draftNews = News::where('is_approved', false)->count();

            $newsByDate = News::selectRaw('DATE(published_at) as date, count(*) as count')
                ->whereNotNull('published_at')
                ->where('is_approved', true)
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            $newsLabels = $newsByDate->pluck('date')->map(fn ($date) => (string) $date)->toArray();
            $newsData = $newsByDate->pluck('count')->toArray();

            $usersByDate = User::selectRaw('DATE(created_at) as date, count(*) as count')
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            $userLabels = $usersByDate->pluck('date')->map(fn ($date) => (string) $date)->toArray();
            $userData = $usersByDate->pluck('count')->toArray();

            $categoryRows = News::select('category', DB::raw('count(*) as count'))
                ->groupBy('category')
                ->orderBy('category')
                ->get();

            $categoryLabels = $categoryRows->pluck('category')->toArray();
            $categoryData = $categoryRows->pluck('count')->toArray();

            $activeUsers = User::where('is_active', true)->count();
            $inactiveUsers = User::where('is_active', false)->count();

            $statusLabels = ['Published', 'Draft'];
            $statusData = [$publishedNews, $draftNews];

            $rolesLabels = ['Users'];
            $rolesData = [$totalUsers];

            $newsStatusLabels = $statusLabels;
            $newsStatusPieData = $statusData;

            $activityLabels = ['Active', 'Inactive'];
            $activityData = [$activeUsers, $inactiveUsers];

            return view('Dashboard.analytics', compact(
                'totalNews',
                'totalUsers',
                'publishedNews',
                'activeUsers',
                'newsLabels',
                'newsData',
                'userLabels',
                'userData',
                'categoryLabels',
                'categoryData',
                'statusLabels',
                'statusData',
                'rolesLabels',
                'rolesData',
                'newsStatusLabels',
                'newsStatusPieData',
                'activityLabels',
                'activityData'
            ));
        }

        public function settings()
        {
            return view('Dashboard.settings');
        }

        public function updateProfile(Request $request)
        {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            ]);

            $user = Auth::user();
            $user->update($validated);

            return redirect()->route('admin.settings')->with('success', 'Profile updated successfully.');
        }

        public function updatePassword(Request $request)
        {
            $validated = $request->validate([
                'current_password' => ['required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user = Auth::user();

            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()->withErrors([
                    'current_password' => 'The current password is incorrect.',
                ]);
            }

            $user->update([
                'password' => Hash::make($validated['password']),
            ]);

            return redirect()->route('admin.settings')->with('success', 'Password updated successfully.');
        }
}
