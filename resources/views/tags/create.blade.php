@extends('layouts.app')
@section('content')

    <div class="card card-default">
        <div class="card-header text-center">
            @if(isset($tag))
                Update tag
            @else
                Create tag
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
            <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}" method="POST">
                @csrf
                @if(isset($tag))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="tag-name">tag Name</label>
                    @if(isset($tag))
                        <input type="text" name="name"
                               id="tag-name" class="form-control"
                               value="{{$tag->name}}">
                    @else
                        <input type="text" name="name"
                               id="tag-name" class="form-control">
                    @endif
                </div>

                @if(isset($tag))
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update tag</button>
                    </div>
                @else
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Add tag</button>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
