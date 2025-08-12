@extends('layouts.layout')
@section('title') Preview | {{ $blogExists->title }} @endsection
@section('section')
    <div style="margin-top: 5rem; padding: 0 4rem; display: flex; flex-direction: column; justify-content: center; align-items: center;">
        @if ($blogExists)
            <div style="width:70%; height: 400px;">
                <img style="width:100%; height:100%; object-fit: cover; border-radius: 20px;"
                    src="{{ $blogExists->img_path }}" alt="blog_image" />
            </div>

            <div style="margin-top: 2rem; padding: 0 10rem;">
                <span style="font-size: 2.5rem; font-weight:600;">{{ $blogExists->title }}</span> <span
                    style="padding: 0.2rem 1rem; background-color: #0462fca3; color: white; border-radius: 30px;">{{ $blogExists->category_name }}</span>
                <p style="color: gray;">{{ $blogExists->description }}</p>
                <p style="color: gray; text-align: right; font-size: 0.9rem;">Posted By <span style="font-weight: 600;">{{$blogExists->author_name}}, </span><span>{{ $blogExists->created_at }}</span></p>
            </div>
        @endif
    </div>
@endsection
