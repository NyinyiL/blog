<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    public function index() {
        return view('blogs.index', [
            'blogs' => Blog::latest()
                                    ->filter(request(['search', 'category', 'username']))
                                    ->paginate(9)  //with('category', 'author')->get()   //eager load // lazy loading
                                    ->withQueryString()
            // 'categories' => Category::all() 
        ]);
    }

    public function show(Blog $blog) 
    {
        // $blog = Blog::find($slug) ;
        return view('blogs.show', [
            'blog' => $blog ,
            'randomBlogs' => Blog::inRandomOrder()->take(3)->get()
        ]);
    }

    public function sub(Blog $blog) {
        if(User::find(auth()->id())->isSubscriped($blog)) {
            return $blog->unSub() ;
        }else {
            return $blog->sub() ;
        }

        // dd($blog) ;
    }

    

    // protected function getBlogs() {
        // $blogs = Blog::latest() ;
        // if((request('search'))) {
        //     $blogs = $blogs->where('title', 'LIKE','%'.request('search').'%')
        //                   ->orWhere('body', 'LIKE','%'.request('search').'%') ;
        // }

        //Laravel OOP feature [ when() is eloquet model method]
        // $query = Blog::latest() ;
        // $query->when(request('search'), function ($query, $search) {
        //     $query->where('title', 'LIKE','%'.$search.'%')
        //         ->orWhere('body', 'LIKE','%'.$search.'%') ;
        // });
        // return $query->get() ;

        // laravel filter
        // return Blog::latest()->filter()->get() ;
    // }
}

