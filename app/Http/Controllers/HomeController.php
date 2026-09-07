<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\BlogPost;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_active', true)->limit(4)->get();
        $latestPosts = BlogPost::published()->latest('published_date')->limit(3)->get();
        
        return view('home', compact('featuredProducts', 'latestPosts'));
    }
}