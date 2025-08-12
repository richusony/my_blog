@extends('layouts.layout')
@section('title')
    Home
@endsection
@section('section')
    <div style="margin-bottom: 3rem; display:flex; justify-content: center;">
        @include('components.category')
    </div>

    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                @if ($blogs)
                    @foreach ($blogs as $key => $value)
                        <div class="post-preview">
                            <div style="width:100%; height:350px;">
                                <img style="width:100%; height:100%; object-fit: cover; border-radius:20px;"
                                    src="{{ $value->img_path }}" alt="blog_image" />
                            </div>
                            <a href="/preview?blog_id={{ $value->id }}">
                                <h2 class="post-title">{{ $value->title }}</h2>
                                <h3 class="post-subtitle">{{ $value->description }}</h3>
                            </a>
                            <p class="post-meta">
                                Posted by
                                <a href="#!">{{ $value->name }}</a>
                                {{ $value->created_at }}
                            </p>
                            <div>
                                <a href="/edit-blog?id={{ $value->id }}"
                                    style="padding: 0.3rem 1rem; background: transparent; border:1px solid blue; color: blue; border-radius:2px;">Edit</a>
                                <a onclick="return window.confirm('are you sure?')"
                                    href="/delete-blog?id={{ $value->id }}"
                                    style="padding: 0.3rem 1rem; background: red; border:none; color: white; border-radius:2px;">Delete</a>
                            </div>
                        </div>
                        <!-- Divider-->
                        <hr class="my-4" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection