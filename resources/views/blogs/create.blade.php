<x-admin-layout>
    <h3 class = "my-3 text-center">Admin Form</h3>
        <x-card-wrapper>
            <form action="/admin/blogs/store" method = "POST" enctype="multipart/form-data">
                @csrf
                {{-- title --}}
                <x-form.input name="title" />
                {{-- introl --}}
                <x-form.input name="intro" />
                {{-- slug --}}
                <x-form.input name="slug" />
                {{-- body --}}
                <x-form.textarea name="body" />
                {{-- photo upload --}}
                <x-form.input name="thumbnail" type="file" />
                {{-- category --}}
                <div class="mb-3">
                    <label for="category" class = "form-label">Category</label>
                    <select name="category_id" id="" class = "form-control">
                        @foreach ($categories as $category)
                        <option {{$category->id==old('category_id') ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </x-card-wrapper>
</x-admin-layout>