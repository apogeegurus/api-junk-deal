<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::query()
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        return response()->json(['blogs' => $blogs]);
    }
//
//    public function show($slug)
//    {
//        $blog = Blog::query()
//            ->where('slug', '=', $slug)
//            ->first();
//
//        $similar = Blog::query()
//            ->select('slug', 'author', 'headline', 'sub_headline', 'main_image')
//            ->where('slug', '<>', $slug)
//            ->limit(10)
//            ->inRandomOrder()
//            ->get();
//
//        return response()->json(['blog' => $blog, 'similars' => $similar]);
//    }
}
