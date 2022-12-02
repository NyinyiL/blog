<x-layout>

    <!-- singloe blog section -->
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto text-center">
          <img
            src="/storage/{{$blog->thumbnail}}"
            class="card-img-top"
            alt="..."
          />
          <h3 class="my-3">{{ $blog->title }}</h3>
          <div>
            <a href = "/users/{{ $blog->author->username }}"><div class="">{{ $blog->author->name }}</div></a>
            <a href = "/categories/{{$blog->category->slug}}"><div class = "badge bg-primary">{{ $blog->category->name }}</div></a>
            <div class = "text-secondary">{{ $blog->created_at->diffForHumans() }}</div>
            <div class = "text-secondary">
              
              <form action="/blogs/{{$blog->slug}}/sub" method = "POST">
                @csrf
                @auth
                @if (auth()->user()->isSubscriped($blog))
                <button class = "btn btn-danger">Unsubscribe</button>
                @else
                <button class = "btn btn-warning">Subscribe</button>
                @endif
                @endauth
                
              </form>
            </div>
          </div>
          <p class="lh-md mt-3">
                {!! $blog->body !!}
          </p>
        </div>
      </div>
    </div>

    <section class = "container">
      <div class="col-md-8 mx-auto">
        @auth
        <x-comment-form :blog="$blog"/>
        @else 
        <p class = "text-center">Please <a href = "/login">login</a> to particatein this discussion</p>
        @endauth
      </div>
    </section>

    {{-- Comments --}}
    @if($blog->comments->count())
    <x-comments :comments="$blog->comments()->latest()->paginate(2)"/>
    @endif
    <!-- subscribe new blogs -->
    {{-- <x-subscribe /> --}}
    {{-- Blog You may like --}}
    <x-blog_you_may_like_section :randomBlogs="$randomBlogs" />
</x-layout>
