<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminBlogController extends Controller
{
    public function index() {
        return view('admin.blogs.index', [
            'blogs' => Blog::latest()->paginate(6)
        ]) ;
    }

    public function create() {
        return view('blogs.create', [
            'categories' => Category::all()
        ]) ;
    }

    public function store() {
         $formData = request()->validate([
            "title" => ["required"] ,
            "intro" => ["required"] ,
            "slug" => ["required" , Rule::unique('blogs', 'slug')] ,
            "body" => ["required"] ,
            "category_id" =>["required" , Rule::exists('categories', 'id')] ,
        ]) ;
        $formData['user_id'] = auth()->id() ;
        $formData['thumbnail'] = request()->file('thumbnail')->store('thumbnails') ;
        Blog::create($formData) ;

        return redirect('/') ;
    }

    public function destory(Blog $blog) {
        $blog->delete() ;
        return back() ;
    }

    public function edit(Blog $blog) {
        return view('admin.blogs.edit', [
            'blog' => $blog ,
            'categories' => Category::all()
        ]) ;
    }
}
