@extends('layouts.layout')
@section('title') Edit blog @endsection
@section('section')
    <div class="container">
        <div style="margin:0 auto; margin-bottom: 2rem; width:70%; height:450px;">
            <img style="width:100%; height:100%; object-fit: cover; border-radius:20px;" src="{{ $blog->img_path }}"
                alt="blog_image" />
        </div>
        {{-- <form method="POST" action="{{ route('blog.edit', $blog->id) }}"
        style="width:300px; height: 400px; padding: 0.5rem 0.8rem; display: flex; flex-direction: column; align-items: center; border: 2px dotted blue; border-radius: 5px;">
        @csrf
        <input type="hidden" name="blog_id" placeholder="Enter title" value="{{ $blog->id }}"
            style="margin:1rem 0; padding: 0.2rem 0.5rem;" />
        <label>Title</label>
        <input type="text" name="title" placeholder="Enter title" value="{{ $blog->title }}"
            style="margin:1rem 0; padding: 0.2rem 0.5rem;" />
        <label>Description</label>
        <input type="text" name="description" placeholder="Enter description" value="{{ $blog->description }}"
            style="margin:1rem 0; padding: 0.2rem 0.5rem;" />
        <label>Image Url</label>
        <input type="text" name="img_path" placeholder="update img url" value="{{ $blog->img_path}}"
            style="margin:1rem 0; padding: 0.2rem 0.5rem;" />
            
        <label>Category</label>
        @if ($categories)
            <select name="category_id" value="{{ $blog->category_id }}" style="padding: 0.5rem 1rem;">
                @foreach ($categories as $key => $value)
                    <option value="{{ $value->id }}"
                    @if ($value->id == $blog->category_id) selected @endif
                    >{{ $value->name }}</option>
                @endforeach
            </select>
        @endif
        <button type="submit" style="margin-top: 1rem; padding: 0.5rem 1rem; border: none; background-color: blue; color: white; border-radius: 20px;">Save</button>
    </form> --}}

        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Blog</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('blog.edit', $blog->id) }}">
                            @csrf
                            <input type="hidden" name="blog_id" placeholder="Enter title" value="{{ $blog->id }}"
                                style="margin:1rem 0; padding: 0.2rem 0.5rem;" />
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Title</label>
                                <input type="text" name="title"  value="{{ $blog->title }}" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="exampleInputPassword1">{{ $blog->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Image Url</label>
                                <input type="text" name="img_path"  value="{{ $blog->img_path }}" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Category</label>
                                @if ($categories)
                                    <select name="category_id" class="form-control" value="{{ $blog->category_id }}"
                                        style="padding: 0.5rem 1rem;">
                                        @foreach ($categories as $key => $value)
                                            <option value="{{ $value->id }}"
                                                @if ($value->id == $blog->category_id) selected @endif>{{ $value->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary rounded">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
