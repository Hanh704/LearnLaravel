<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Post;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy danh sách banner có status = 1
        $banners = Banner::where('status', 1)->get();
        
        // Phần còn lại của code giữ nguyên
        $latestProducts = Product::latest()->take(8)->get();
        $latestPosts = Post::orderBy('created_at', 'desc')->get();
        $topReviews = Review::orderBy('rating', 'desc')
            ->latest()
            ->take(10)
            ->with(['user', 'product'])
            ->get();
            
        return view('client.home', compact('banners', 'latestProducts', 'latestPosts', 'topReviews'));
    }
}
