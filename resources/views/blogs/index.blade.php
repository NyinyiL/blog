<x-layout>
    {{-- hero section --}}
    <x-hero />
    <!-- blogs section -->
    <x-blog-section :blogs="$blogs" 
    {{-- :categories="$categories"  
    :currentCategory="$currentCategory ?? null" --}}
    />
    {{-- Subscribe section --}}
    {{-- <x-subscribe />     --}}
</x-layout>

<!-- :currentCategory="$currentCategory" -->