@extends('layouts.layout')
@section('title')
    Create Category
@endsection
@section('section')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Create Category</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('category.create') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                            <button type="submit" class="btn btn-primary rounded">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h3 style="margin-top: 4rem; margin-bottom: 2rem; text-align: center; font-weight: 600; color: gray;">List of Categories</h3>
        <div style="margin-top: 1rem; display: flex; justify-content: center; align-items: center; gap: 1rem;">
            @include('components.category-card')
        </div>
    </div>
@endsection
