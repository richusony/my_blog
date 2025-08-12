@extends('layouts.layout')
@section('title') Post blog @endsection
@section('section')
    <div class="container">
        {{-- <form method="POST" action="{{ route('blog.create') }}"
            style="width:300px; height: 400px; padding: 0.5rem 0.8rem; display: flex; flex-direction: column; align-items: center; border: 2px dotted blue; border-radius: 5px;">
            @csrf
            <input type="text" name="title" placeholder="Enter title" style="margin:1rem 0; padding: 0.2rem 0.5rem;" />
            <input type="text" name="description" placeholder="Enter description"
                style="margin:1rem 0; padding: 0.2rem 0.5rem;" />
            <input type="text" name="img_path" placeholder="Enter img url"
                style="margin:1rem 0; padding: 0.2rem 0.5rem;" />

            @if ($categories)
                <select name="category_id" style="padding: 0.5rem 1rem;">
                    @foreach ($categories as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            @endif
            <button type="submit"
                style="margin-top: 1rem; padding: 0.5rem 1rem; border: none; background-color: blue; color: white; border-radius: 20px;">Post</button>
        </form> --}}

        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Post Blog</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('blog.create') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="exampleInputPassword1"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Image Url</label>
                                <input type="text" name="img_path" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Category</label>
                                @if ($categories)
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary rounded">Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
