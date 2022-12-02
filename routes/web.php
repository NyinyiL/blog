<?php

use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminBlogController;


Route::get('send-email', [EmailController::class, 'sendEmail']);


Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/invoice', function() {
    // return view('invoice') ;

    $pdf = Pdf::loadView('invoice');
    return $pdf->download('new.pdf');
}) ;


Route::get('/', [BlogController::class, 'index']);

Route::get('/blogs/{blog:slug}', [BlogController::class, 'show'])->where('blog', '[A-z\d\-_]+') ;
Route::post('/blogs/{blog:slug}/comments', [CommentController::class, 'store']) ;

Route::get('/register', [AuthController::class, 'create']) ;
Route::post('/register', [AuthController::class, 'store']) ;
Route::post('/logout', [AuthController::class, 'logout']) ;
Route::get('/login', [AuthController::class, 'login'])->middleware('guest') ;
Route::post('/login', [AuthController::class, 'post_login'])->middleware('guest') ;

Route::post('/blogs/{blog:slug}/sub', [BlogController::class , 'sub']) ;

//admin route

Route::get('/admin/blogs', [AdminBlogController::class, 'index'])->middleware('admin') ;
Route::get('/admin/blogs/create', [AdminBlogController::class, 'create'])->middleware('admin') ;
Route::post('/admin/blogs/store', [AdminBlogController::class, 'store'])->middleware('admin') ;
Route::delete('/admin/blogs/{blog:slug}/delete', [AdminBlogController::class, 'destory'])->middleware('admin') ;

Route::get('/admin/blogs/{blog:slug}/edit', [AdminBlogController::class, 'edit'])->middleware('admin') ;








// ** don't need to use this route bsc blogcontroller can respon all thing from this route
// Route::get('/categories/{category:slug}', function(Category $category) {
//     return view('blogs', [
//         'blogs' => $category->blogs ,//->load('category', 'author')
//         'categories' => Category::all() ,
//         'currentCategory' => $category
//     ]);
// }) ;

// Route::get('/users/{user:username}', function(User $user) {
//     return view('blogs', [
//         'blogs' => $user->blogs //Blog::without('category', 'author')->get()
//         // 'categories' => Category::all() 
//     ]);
// }) ;

