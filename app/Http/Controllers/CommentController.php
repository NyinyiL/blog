<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Mail\SubscriberMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Mail ;
// use App\Http\Controllers\SubMail ;

class CommentController extends Controller
{
    public function store(Blog $blog) { //route model binding
        request()->validate([
            'body' => "required | min:5" ,
        ]) ;

        
        // comment store
        $blog->comments()->create([
            'body' => request('body') ,
            'user_id' => auth()->id() ,
        ]) ;

        $subscribers = $blog->subscribers->filter(fn ($subscriber) => $subscriber->id !== auth()->id()) ;

        $subscribers->each(function ($subscriber) use ($blog) {
            Mail::to($subscriber->email)->queue(new SubscriberMail($blog)) ;
        }) ;
        // mail
        // $subscribers = $blog->subscribers->filter(fn ($subscribers) => $subscribers->id != auth()->id()) ; 
        // $subscribers->each(function ($subscriber) use ($blog) { 
        //     Mail::to($subscriber->email)->queue(new SubMail($blog)) ;
        // }) ;

        return redirect('/blogs/' . $blog->slug) ;
    }
}
