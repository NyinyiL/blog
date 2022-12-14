<!-- navbar -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/">Slove Error</a>
      <div class="d-flex">
        <a href="/#blogs" class="nav-link">Blogs</a>

        @guest
        <a href="/register" class="nav-link">Register</a>
        <a href="/login" class="nav-link">Login</a>
        @else
        <img src = "{{ auth()->user()->avator }}" width = "50" height = "50" class = "rounded-circle">
        <a href = "" class = "nav-link">Welcome {{ auth()->user()->name }}</a>
        <form action="/logout" method = "POST">
          @csrf
          <button type = "submit" class = "nav-link btn btn-link">Logout</button>
        </form>
        @endguest

        {{-- @if (auth()->check()) --}}
        {{-- @auth
            <form action="/logout" method = "POST">
              @csrf
              <button type = "submit" class = "nav-link btn btn-link">Logout</button>
            </form> --}}
        {{-- @endif --}}
        {{-- @endauth --}}
        <a href="#subscribe" class="nav-link">Subscribe</a>
      </div>
    </div>
  </nav>