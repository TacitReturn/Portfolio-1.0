@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            {{ isset($post) ? 'Edit Post' : 'Create Post' }}
        </div>
        <div class="card-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}" method="POST"
                  enctype="multipart/form-data">
                @if(isset($post))
                    @method('PUT')
                @endif

                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="title" id="title"
                           value="{{ isset($post) ? $post->title : old('title') }}">
                </div>
                @if(isset($post))
                    <div class="form-group">
                        <img src="{{ asset("storage/$post->image") }}" alt="{{ $post->title }}" style="width: 100%">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input name="image" type="file" class="form-control-file" id="image" value="{{ $post->image }}">
                    </div>
                @else
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input name="image" type="file"
                               class="form-control-file"
                               id="image">
                    </div>
                @endif

                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if (isset($post))
                                    @if($category->id === $post->category_id)
                                    selected
                                @endif
                                @endif
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="5" rows="5"
                              class="form-control">{{isset($post) ? $post->description : old('description')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input value="{{ isset($post) ? $post->content : old('content') }}" id="content" type="hidden"
                           name="content"
                           class="form-control">
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input id="published_at" name="published_at" class="form-control"
                           value="{{ isset($post) ? $post->published_at : old('published_at') }}">
                </div>

                <div class="form-group">
                    <button class="btn btn-success">
                        {{ isset($post) ? 'Update Post' : 'Create Post' }}
                    </button>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script type="text/javascript">
        let publishedAt = document.getElementById('published_at');
        flatpickr(publishedAt, {

            enableTime: true,
        })
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

