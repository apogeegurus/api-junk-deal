<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\Store;
use App\Http\Requests\Blog\Update;
use App\Models\Blog;
use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::query()->paginate(20);
        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $blogData = $request->only(['headline', 'sub_headline', 'description', 'author','alt']);
        $mainImage  = $request->file('mainImage');
        $ext = $mainImage->getClientOriginalExtension();
        $fileName = Str::random(32) . ".{$ext}";
        Storage::disk('public')->putFileAs("blogs/main/", $mainImage, $fileName);

        $data = ['main_image' => $fileName] + $blogData;
        Blog::query()->create($data);

        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Blog $blog)
    {
        $blogData = $request->only(['headline', 'sub_headline', 'description', 'author','alt']);
        $mainImage  = $request->file('mainImage');


        if(!empty($mainImage)) {
            Storage::disk('public')->delete("blogs/main/{$blog->main_image}");
            $ext = $mainImage->getClientOriginalExtension();
            $fileName = Str::random(32) . ".{$ext}";
            Storage::disk('public')->putFileAs("blogs/main", $mainImage, $fileName);

            $blogData = ['main_image' => $fileName] + $blogData;
        }

        $blog->update($blogData);

        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        Storage::disk('public')->deleteDirectory('blogs/main/' .  $blog->id);

        $blog->delete();
        return response()->json(['success' => true]);
    }


    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move(public_path('ckeditor-images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('ckeditor-images/'.$fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
