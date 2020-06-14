@extends('layouts.app')
@section('content')

    <div class="card card-default">
        <div class="card-header text-center">
            @if(isset($category))
                Update Category
            @else
                Create Category
            @endif

        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="category-name">Category Name</label>
                    @if(isset($category))
                        <input type="text" name="name"
                               id="category-name" class="form-control"
                               value="{{$category->name}}">
                    @else
                        <input type="text" name="name"
                               id="category-name" class="form-control">
                    @endif
                </div>

                @if(isset($category))
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update Category</button>
                    </div>
                @else
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Add Category</button>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
